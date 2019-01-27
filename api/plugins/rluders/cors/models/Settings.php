<?php

namespace RLuders\Cors\Models;

use Model;

class Settings extends Model
{
    /**
     * Model extensions
     *
     * @var array
     */
    public $implement = ['System.Behaviors.SettingsModel'];

    /**
     * Settings code
     *
     * @var string
     */
    public $settingsCode = 'rluders_cors_settings';

    /**
     * Settings form
     *
     * @var string
     */
    public $settingsFields = 'fields.yaml';

    /**
     * Initial plugin settings
     *
     * @return void
     */
    public function initSettingsData()
    {
        $this->supportsCredentials = false;
        $this->allowedOrigins = '*';
        $this->allowedHeaders = 'Content-Type X-Requested-With';
        $this->allowedMethods = '*';
        $this->exposedHeaders = '';
        $this->maxAge = 0;
    }
}
