PPI Monolog Module
==================

[@php]:     http://php.net/         "PHP: Hypertext Preprocessor"
[@ppi]:     http://ppi.io/          "PPI Framework - The PHP Meta Framework!"
[@monolog]: https://github.com/Seldaek/monolog  "Sends your logs to files, sockets, inboxes, databases and various web services"

[Monolog][@monolog] module for [PPI2][@ppi].

[![Total Downloads](https://poser.pugx.org/ppi/monolog-module/downloads.png)](https://packagist.org/packages/ppi/monolog-module)
[![Latest Stable Version](https://poser.pugx.org/ppi/monolog-module/v/stable.png)](https://packagist.org/packages/ppi/monolog-module)
[![Latest Unstable Version](https://poser.pugx.org/ppi/monolog-module/v/unstable.png)](https://packagist.org/packages/ppi/monolog-module)
[![Build Status](https://secure.travis-ci.org/ppi/ppi-monolog-module.png)](http://travis-ci.org/ppi/ppi-monolog-module)
[![License](https://poser.pugx.org/ppi/monolog-module/license.png)](https://packagist.org/packages/ppi/monolog-module)

Monolog
-------

> Monolog sends your logs to files, sockets, inboxes, databases and various web services. See the complete list of handlers below. Special handlers allow you to build advanced logging strategies.
>
> This library implements the [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md) interface that you can type-hint against in your own libraries to keep
a maximum of interoperability. You can also use it in your applications to make sure you can always use another compatible logger at a later time.

Requirements
------------

* [PHP][@php] 5.3.3 and up
* [PPI Framework 2][@ppi] (2.1.x)

Installation
------------

### 1. Install Composer

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

``` bash
curl -s http://getcomposer.org/installer | php
```

### 2. Add ppi/monolog-module to your composer.json and install it

``` bash
$ php composer.phar require ppi/monolog-module dev-master
```

Composer will install the module to your project's `vendor/ppi` directory.

### 3. Enable the module

Enable this module by editing `app/config/modules.yml`:

``` yml
modules:
    - PPI\MonologModule
    # ...
```

License
-------

This module is licensed under the MIT License. See the [LICENSE file](https://github.com/ppi/ppi-monolog-module/blob/master/LICENSE) for details.

Authors
-------

* Vítor Brandão - <vitor@ppi.io> ~ [twitter.com/noiselabs](http://twitter.com/noiselabs) ~ [noiselabs.org](http://noiselabs.org)

See also the list of [contributors](https://github.com/ppi/ppi-monolog-module/contributors) who participated in this project.

Submitting bugs and feature requests
------------------------------------

Bugs and feature requests are tracked on [GitHub](https://github.com/ppi/ppi-monolog-module/issues).

About PPI
---------

<img src="https://upload.wikimedia.org/wikipedia/commons/7/7d/Ppi-framework-logo.png" width="74" height="50" />

> PPI is an open source PHP meta-framework. It has taken the good bits from Symfony2, ZendFramework2 & Doctrine2 and combined them together to create a solid and very easy web application framework. It can be considered the boilerplate of PHP frameworks.
