<?php
/**
 * This file is part of SHIELDFY Web Application Firewall Detector.
 * (c) 2016 SHIELDFY, All rights reserved.
 *
 * The code provided was developed by Matthias "Nihylum" Kaschubowski
 *
 * The applied license is stored at the root directory of this package.
 */

namespace Shieldfy\Firewall;


use Shieldfy\FirewallInterface;

/**
 * Incapsula Firewall Class
 *
 * @package shieldfy.waf-detector
 * @author  Matthias Kaschubowski <nihylum@gmail.com>
 */
class Incapsula implements FirewallInterface
{
    /**
     * returns the name of the firewall
     *
     * @return string
     */
    public function getName()
    {
        return "Incapsula";
    }

    /**
     * detects whether the provided headers and body string does match the firewall identification rules or not.
     *
     * @param string[] $headers
     * @param string   $bodyString
     * @param string   $url
     *
     * @return bool
     */
    public function detect(array $headers, $bodyString, $url)
    {
        return array_key_exists('x-cdn', $headers) && strtolower($headers['x-cdn']) === 'incapsula';
    }

}
