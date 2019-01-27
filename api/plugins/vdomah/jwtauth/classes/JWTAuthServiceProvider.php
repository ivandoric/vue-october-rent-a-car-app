<?php namespace Vdomah\JWTAuth\Classes;

use Config;

class JWTAuthServiceProvider extends \Tymon\JWTAuth\Providers\JWTAuthServiceProvider
{

    /**
     * Helper to get the config values.
     *
     * @param  string $key
     * @return string
     */
    protected function config($key, $default = null)
    {
        $val = Config::get('vdomah.jwtauth::' . $key);

        return $val ?: config("jwt.$key", $default);
    }
}