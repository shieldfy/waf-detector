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
 * Mod_Security Firewall Class
 *
 * @deprecated The checkup does suffer from inconsistency, high fake possibility
 *
 * @package    shieldfy.waf-detector
 * @author     Matthias Kaschubowski <nihylum@gmail.com>
 */
class ModSecurity implements FirewallInterface
{
    /**
     * returns the name of the firewall
     *
     * @return string
     */
    public function getName()
    {
        return 'mod_security';
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
        $response = @ file_get_contents("{$url}/../../etc");

        if (strstr($response['content'], 'Mod_Security')) {
            return true;
        }

        return false;
    }

}
