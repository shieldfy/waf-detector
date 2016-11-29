# SHIELDFY Web Application Firewall Detector

This is a simple package for Web Application Firewall Detection. It supports CloudFlare, Incapsula, ModSecurity, and Shieldfy out of the box. 

[![Packagist](https://img.shields.io/packagist/v/shieldfy/waf-detector.svg?label=Packagist&style=flat-square)](https://packagist.org/packages/shieldfy/waf-detector)
[![VersionEye Dependencies](https://img.shields.io/versioneye/d/php/shieldfy:waf-detector.svg?label=Dependencies&style=flat-square)](https://www.versioneye.com/php/shieldfy:waf-detector/)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/shieldfy/waf-detector.svg?label=Scrutinizer&style=flat-square)](https://scrutinizer-ci.com/g/shieldfy/waf-detector/)
[![Code Climate](https://img.shields.io/codeclimate/github/shieldfy/waf-detector.svg?label=CodeClimate&style=flat-square)](https://codeclimate.com/github/shieldfy/waf-detector)
[![License](https://img.shields.io/packagist/l/shieldfy/waf-detector.svg?label=License&style=flat-square)](https://github.com/shieldfy/waf-detector/blob/develop/LICENSE)


## Table Of Contents

- [Usage](#usage)
- [Installation](#installation)
- [Changelog](#changelog)
- [Support](#support)
- [Contributing & Protocols](#contributing--protocols)
- [Security Vulnerabilities](#security-vulnerabilities)
- [License](#license)


## Usage

Usage is pretty easy and straightforward:

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


## Installation

Install the package via composer:
```shell
composer require shieldfy/waf-detector
```


## Changelog

Refer to the [Changelog](CHANGELOG.md) for a full history of the project.


## Support

The following support channels are available at your fingertips:

- [Help on Email](mailto:team@shieldfy.com)


## Contributing & Protocols

Thank you for considering contributing to this project! The contribution guide can be found in [CONTRIBUTING.md](CONTRIBUTING.md).

Bug reports, feature requests, and pull requests are very welcome.

- [Versioning](CONTRIBUTING.md#versioning)
- [Pull Requests](CONTRIBUTING.md#pull-requests)
- [Coding Standards](CONTRIBUTING.md#coding-standards)


## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to [security@shieldfy.com](security@shieldfy.com). All security vulnerabilities will be promptly addressed.


## License

This software is released under [MIT LICENSE](LICENSE).

(c) 2016 Shieldfy, Some rights reserved.
