<?php
/**
 * This file is part of SHIELDFY Web Application Firewall Detector.
 * (c) 2016 SHIELDFY, All rights reserved.
 *
 * The code provided was developed by Matthias "Nihylum" Kaschubowski
 *
 * The applied license is stored at the root directory of this package.
 */

// dependencies
require __DIR__.'/../src/Exception/InvalidUrlException.php';
require __DIR__.'/../src/FirewallInterface.php';

// firewalls
require __DIR__.'/../src/Firewall/CloudFlare.php';
require __DIR__.'/../src/Firewall/Incapsula.php';
require __DIR__.'/../src/Firewall/ModSecurity.php';
require __DIR__.'/../src/Firewall/Shieldfy.php';

// detector
require __DIR__.'/../src/Detector.php';

// configuration

$firewalls = [
    new \Shieldfy\Firewall\CloudFlare(),
    new \Shieldfy\Firewall\Incapsula(),
    new \Shieldfy\Firewall\ModSecurity(),
    new \Shieldfy\Firewall\Shieldfy(),
];

// bootstrap

set_exception_handler(function (Exception $exception) {
    $output = [
        '',
        sprintf('%s:', get_class($exception)),
        $exception->getMessage(),
        '',
    ];

    echo PHP_EOL.join(PHP_EOL, $output).PHP_EOL;
});

$detector = new \Shieldfy\Detector(... $firewalls);

echo <<<ASCIIART
  |`-._/\_.-`|
  |    ||    | Web
  |___o()o___| Application
  |__((<>))__| Firewall
  \   o\/o   / Detector
   \   ||   /
    \  ||  /   by Shieldfy.com
     '.||.'
       ``
(c) 2016 Shieldfy Security Team
(c) 2016 Matthias "Nihylum" Kaschubowski
ASCIIART;

if (! isset($argv[1]) || (isset($argv[1]) && $argv[1] === 'help')) {
    $help = [
        '',
        'Usage:',
        '',
        'php waf-detector.php http://example.com',
        '',
    ];

    echo PHP_EOL.join(PHP_EOL, $help).PHP_EOL;
} else {
    echo PHP_EOL.PHP_EOL.'Checking: '.$argv[1].PHP_EOL;

    foreach ($detector->detect($argv[1]) as $firewall => $result) {
        echo PHP_EOL."- {$firewall} ... ".($result ? 'enabled' : 'disabled');
    }

    echo PHP_EOL.PHP_EOL;
}
