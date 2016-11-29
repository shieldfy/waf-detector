<?php
/**
 * This file is part of SHIELDFY Web Application Firewall Detector.
 * (c) 2016 SHIELDFY, All rights reserved.
 *
 * The code provided was developed by Matthias "Nihylum" Kaschubowski
 *
 * The applied license is stored at the root directory of this package.
 */

namespace Shieldfy;


use Shieldfy\Exception\InvalidUrlException;

/**
 * Detector Class
 *
 * @package shieldfy.waf-detector
 * @author  Matthias Kaschubowski <nihylum@gmail.com>
 */
class Detector
{
    /**
     * Holds all firewall identification interfaces
     *
     * @var FirewallInterface[]
     */
    protected $firewalls = [];

    /**
     * holds the general cURL settings
     *
     * @var array
     */
    protected $cUrlOptions = [
        CURLOPT_HEADER         => 1,
        CURLOPT_VERBOSE        => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows; U;Windows NT 5.1; ru; rv:1.8.0.9) Gecko/20061206 Firefox/1.5.0.9',
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
    ];

    /**
     * Detector constructor.
     *
     * @param FirewallInterface[] ...$firewalls
     */
    public function __construct(FirewallInterface ... $firewalls)
    {
        $this->firewalls = $firewalls;
    }

    /**
     * creates a report (iterator) of the provided url.
     *
     * The iterator provides a firewall name as it keys and a checkup-result boolean as it values.
     *
     * @param string $url
     *
     * @return \Iterator
     */
    public function detect($url)
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidUrlException("incompatible url given: {$url}");
        }

        $response = $this->fetch($url);

        foreach ($this->firewalls as $firewall) {
            yield $firewall->getName() => $firewall->detect($response['headers'], $response['body'], $url);
        }
    }

    /**
     * fetches the contents of the given url.
     *
     * @param string $url
     *
     * @return array [headers=>..., body=>...]
     */
    protected function fetch($url)
    {
        $resource = curl_init($url);
        curl_setopt_array($resource, $this->cUrlOptions);
        $response = curl_exec($resource);

        if (! in_array($httpCode = curl_getinfo($resource, CURLINFO_HTTP_CODE), [302, 301, 304, 200])) {
            throw new InvalidUrlException("Given url returns abnormal http status code: {$httpCode}");
        }

        curl_close($resource);

        list($headerString, $bodyString) = explode("\r\n\r\n", $response, 2);

        return [
            'headers' => iterator_to_array($this->marshalHeaders($headerString)),
            'body'    => $bodyString,
        ];
    }

    /**
     * marshals the header from a header string.
     *
     * @param $headerString
     *
     * @return \Generator
     */
    protected function marshalHeaders($headerString)
    {
        $headers = explode("\r\n", $headerString);

        foreach ($headers as $current) {
            if (false !== strpos($current, ': ')) {
                list($key, $value) = explode(': ', $current, 2);
                yield strtolower($key) => $value;
            }
        }
    }
}
