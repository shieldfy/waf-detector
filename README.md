# SHIELDFY Web Application Firewall Detector

This is the Shieldfy Web Application Firewall Detection Component.

### Usage

```php

$firewalls = [
    new \Shieldfy\Firewall\CloudFlare(),
    new \Shieldfy\Firewall\Incapsula(),
    new \Shieldfy\Firewall\ModSecurity(),
    new \Shieldfy\Firewall\Shieldfy(),
];

$detector = new \Shieldfy\Detector(... $firewalls);

foreach ( $detector->detect('http://www.example.com') as $firewall => $status ) {
    // do something, perhaps displaying the status ?
}

```

### At the Command Line

```
# php bin/waf-detector.php http://example.org
```
