# Rest Plugin for CakePHP

[![Build Status](https://travis-ci.org/pnglabz/cakephp-rest.svg?branch=master)](https://travis-ci.org/pnglabz/cakephp-rest)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/pnglabz/cakephp-rest/master/LICENSE)
[![Total Downloads](https://poser.pugx.org/pnglabz/cakephp-rest/downloads)](https://packagist.org/packages/pnglabz/cakephp-rest)
[![Latest Stable Version](https://poser.pugx.org/pnglabz/cakephp-rest/v/stable)](https://packagist.org/packages/pnglabz/cakephp-rest)

This plugin simplifies the REST API development for your CakePHP 3 application. It simply converts the output of your controller into a JSON response.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require pnglabz/cakephp-rest
```

After installation, [Load the plugin](http://book.cakephp.org/3.0/en/plugins.html#loading-a-plugin)

```php
Plugin::load('Rest', ['bootstrap' => true]);
```

Or, you can load the plugin using the shell command

```sh
$ bin/cake plugin load -b Rest
```

## Usage

No major change requrires in the way you code in your CakePHP application. Simply, just add one parameter to your route configuration `isRest` like,

```php
$routes->connect('/foo/bar', ['controller' => 'Foo', 'action' => 'bar', 'isRest' => true]);
```

And extend your controller to `RestController` and everything will be handled by the plugin itself. For example,

```php
<?php

namespace App\Controller;

use Rest\Controller\RestController;

/**
 * Foo Controller
 *
 */
class FooController extends RestController
{

    /**
     * bar method
     *
     * @return Response|void
     */
    public function bar()
    {
        $bar = [
            'falanu' => [
                'dhikanu',
                'tamburo'
            ]
        ];

        $this->set(compact('bar'));
    }
}

```

And that's it. You will see the response as below.

```json
{
    "status": "OK",
    "result": {
        "bar": {
            "falanu": [
                "dhikanu",
                "tamburo"
            ]
        }
    }
}
```

Doesn't it too simple? Whatever `viewVars` you set from your controller's action using `set()` method, will be converted into JSON response.
