<?php

namespace RLuders\JWTAuth\Models;

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
    public $settingsCode = 'rluders_jwtauth_settings';

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
        $this->algo = 'HS256';
        $this->secret = 'changeYourSecretKey';
        $this->keys_public = null;
        $this->keys_private = null;
        $this->keys_passphrase = null;
        $this->ttl = 60;
        $this->refresh_ttl = 20160;
        $this->required_claims = 'iss iat exp nbf sub jti';
        $this->persistent_claims = null;
        $this->lock_subject = true;
        $this->leeway = 0;
        $this->blacklist_enabled = true;
        $this->blacklist_grace_period = 0;
        $this->encrypt_cookies = false;
        $this->activation_url = '/#/auth/activation/{code}';
        $this->reset_password_url = '/#/auth/reset-password/{code}';
    }
}
