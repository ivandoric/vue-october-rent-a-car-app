<?php

namespace OFFLINE\CORS\Classes;

use October\Rain\Support\ServiceProvider as BaseServiceProvider;
use OFFLINE\CORS\Models\Settings;

class ServiceProvider extends BaseServiceProvider
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
        $this->app->singleton(CorsService::class, function ($app) {
            return new CorsService($this->getSettings());
        });
    }

    /**
     * Return default Settings
     */
    protected function getSettings()
    {
        $supportsCredentials = (bool)$this->getConfigValue('supportsCredentials', false);
        $maxAge              = (int)$this->getConfigValue('maxAge', 0);
        $allowedOrigins      = $this->getConfigValue('allowedOrigins', []);
        $allowedHeaders      = $this->getConfigValue('allowedHeaders', []);
        $allowedMethods      = $this->getConfigValue('allowedMethods', []);
        $exposedHeaders      = $this->getConfigValue('exposedHeaders', []);

        return compact(
            'supportsCredentials',
            'allowedOrigins',
            'allowedHeaders',
            'allowedMethods',
            'exposedHeaders',
            'maxAge'
        );
    }

    /**
     * Returns an effective config value.
     *
     * If a filesystem config is available it takes precedence
     * over the backend settings values.
     *
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    public function getConfigValue($key, $default = null)
    {
        return $this->filesystemConfig($key) ?: $this->getValues(Settings::get($key, $default));
    }

    /**
     * Return the filesystem config value if available.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function filesystemConfig($key)
    {
        return config('offline.cors::' . $key);
    }

    /**
     * Extract the repeater field values.
     *
     * @param mixed $values
     *
     * @return array
     */
    protected function getValues($values)
    {
        return \is_array($values) ? collect($values)->pluck('value')->toArray() : $values;
    }
}