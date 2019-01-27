<?php

namespace RLuders\Cors\Providers;

use Config;
use Asm89\Stack\CorsService;
use Barryvdh\Cors\HandleCors;
use Barryvdh\Cors\HandlePreflight;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use RLuders\Cors\Models\Settings;

class CorsServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            CorsService::class,
            function ($app) {
                $options = $app['config']->get('cors');

                if (isset($options['allowedOrigins'])) {
                    foreach ($options['allowedOrigins'] as $origin) {
                        if (strpos($origin, '*') !== false) {
                            $options['allowedOriginsPatterns'][] = $this->convertWildcardToPattern($origin);
                        }
                    }
                }

                return new CorsService($options);
            }
        );
    }

    /**
     * Add the Cors middleware to the router.
     *
     */
    public function boot()
    {
        $this->loadConfiguration();

        $kernel = $this->app->make(Kernel::class);

        // When the HandleCors middleware is not attached globally, add the PreflightCheck
        if (!$kernel->hasMiddleware(HandleCors::class)) {
            $kernel->prependMiddleware(HandlePreflight::class);
        }

        $this->app['router']->middleware('cors', \Barryvdh\Cors\HandleCors::class);
    }

    /**
     * Create a pattern for a wildcard, based on Str::is() from Laravel
     *
     * @see https://github.com/laravel/framework/blob/5.5/src/Illuminate/Support/Str.php
     * @param $pattern
     * @return string
     */
    protected function convertWildcardToPattern($pattern)
    {
        $pattern = preg_quote($pattern, '#');

        // Asterisks are translated into zero-or-more regular expression wildcards
        // to make it convenient to check if the strings starts with the given
        // pattern such as "library/*", making any string check convenient.
        $pattern = str_replace('\*', '.*', $pattern);

        return '#^'.$pattern.'\z#u';
    }

    /**
     * Load plugin configuration
     *
     * @return void
     */
    protected function loadConfiguration()
    {
        Config::set(
            'cors',
            [
                'supportsCredentials' => (bool)Settings::get('supportsCredentials'),
                'allowedOrigins' => explode(' ', Settings::get('allowedOrigins')),
                'allowedHeaders' => explode(' ', Settings::get('allowedHeaders')),
                'allowedMethods' => explode(' ', Settings::get('allowedMethods')),
                'exposedHeaders' => explode(' ', Settings::get('exposedHeaders')),
                'maxAge' => (int)Settings::get('maxAge')
            ]
        );
    }
}
