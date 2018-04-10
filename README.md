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

### Response Format
This plugin returns the response in following format.

```json
{
    "status": "OK",
    "result": {
        ...
    }
}
```
The `status` key may contain OK or NOK based on your response code. For all successful responses, the code will be 200 and the value of this key will be OK. 

In case of error or exception, the value of `status` will become NOK. Also, based on your application's `debug` setting, it will contain the exception and trace data.

The `result` key contains the actual response. It holds all the variables set from your controller. This key will not be availabe in case of error/exception.

## Require Authentication??
This plugin also provides an option to authenticate request using JWT. Simply, just add one more parameter to your route configuration `requireAuthorization` like,

```php
$routes->connect('/foo/bar', ['controller' => 'Foo', 'action' => 'bar', 'isRest' => true, 'requireAuthorization' => true]);
```

Now, the plugin will check for the JWT token in the request in form of header, query parameter or post data. If you want to pass the token in header, use following format.

```
Authorization: Bearer [token]
```

And for query parameter or post data, use `token` parameter and set the token as value of the parameter.

### Generate token
If you require the authentication in API, you first must grant the token to the user who is making the API request. In general, when user logs in, the response should contain the token for all next requests.

To generate token, use the method from Utility class of the plugin: `JwtToken::generate()`.

```
/**
 * login method
 *
 * @return Response|void
 */
public function login()
{
    // you user authentication code will go here, you can compare the user with database or whatever
    
    $payload = [
        'id' => "Your User's ID",
        'other' => "Some other data"
    ];

    $token = \Rest\Utility\JwtToken::generate($payload);

    $this->set(compact('token'));
}
```

And it will return the token in response. So, in next api calls, user can use that token for authorization. You can add whatever data is required in your payload.

By default, the plugin uses the predefined key and algorithm to generate JWT token. You can update this configuration by creating `config/rest.php` file. The content of the this configuration file will be as following,

```php
<?php
return [
    'Rest' => [
        'jwt' => [
            'key' => 'PUT YOUR KEY HERE', // it should contain alphanumeric string with symbols
            'algorithm' => 'HS256' // See https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
        ]
    ]
];
```

### Access token data
If there is a valid token available in request, you can access it in your controller using the `token` and `payload` properties.

```
/**
 * view method
 *
 * @return Response|void
 */
public function view()
{
    $token = $this->token;

    $payload = $this->payload;

    // your action logic...
}
```
These properties is also available in your controller's `beforeFilter` method, so you can put additional authentication logic there.
