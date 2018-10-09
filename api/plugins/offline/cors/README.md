# CORS plugin for October CMS

This plugin is based on [https://github.com/barryvdh/laravel-cors](https://github.com/barryvdh/laravel-cors/blob/master/config/cors.php).

All configuration for the plugin can be done via the backend settings.

The following cors headers are supported:

* Access-Control-Allow-Origin
* Access-Control-Allow-Headers
* Access-Control-Allow-Methods
* Access-Control-Allow-Credentials
* Access-Control-Expose-Headers
* Access-Control-Max-Age

Currently these headers are sent for every request. There is no per-route configuration possible at this time.

## Setup

After installing the plugin visit the CORS settings page in your October CMS backend settings.

You can add `*` as an entry to `Allowed origins`, `Allowed headers` and `Allowed methods` to allow any kind of CORS request from everywhere.

It is advised to be more explicit about these settings. You can add values for each header via the repeater fields.

> It is important to set these intial settings once for the plugin to work as excpected!

### Filesystem configuration

As an alternative to the backend settings you can create a `config/config.php` file in the plugins root directory to configure it.

The filesystem configuration will overwrite any defined backend setting.

```php
<?php
// plugins/offline/cors/config/config.php
return [
    'supportsCredentials' => true,
    'maxAge'              => 3600,
    'allowedOrigins'      => ['*'],
    'allowedHeaders'      => ['*'],
    'allowedMethods'      => ['GET', 'POST'],
    'exposedHeaders'      => [''],
];
```