<?php

namespace OFFLINE\CORS\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'offline_cors_settings';
    public $settingsFields = 'fields.yaml';
}