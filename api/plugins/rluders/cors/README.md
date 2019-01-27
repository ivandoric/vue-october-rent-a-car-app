# CORS Plugin

This plugin provides a simple CORS support your for [OctoberCMS](http://www.octobercms.com) implementing the [barryvdh/laravel-cors](https://github.com/barryvdh/laravel-cors).

## Installation

1. Clone this repository:

`$ git clone https://github.com/rluders/oc-cors-plugin.git plugins/rluders/cors`

2. Install the composer dependencies:

`$ cd plugins/rluders/cors`  
`$ composer install`

3. Configure it on your OctoberCMS Backend.

4. Use it on your `route.php`

```php

<?php 

Route::group(['prefix' => 'api/e1', 'middleware' => ['\Barryvdh\Cors\HandleCors']], function(){
    // routes here
});

```

## Support on Beerpay

Hey dude! Help me out for a couple of beers!

[![Beerpay](https://beerpay.io/rluders/oc-cors-plugin/badge.svg)](https://beerpay.io/rluders/oc-cors-plugin) [![Beerpay](https://beerpay.io/rluders/oc-cors-plugin/make-wish.svg)](https://beerpay.io/rluders/oc-cors-plugin)
