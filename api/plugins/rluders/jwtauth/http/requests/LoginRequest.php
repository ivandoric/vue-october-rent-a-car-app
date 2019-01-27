<?php

namespace RLuders\JWTAuth\Http\Requests;

use RLuders\JWTAuth\Http\Requests\Request;
use RainLab\User\Models\Settings as UserSettings;

class LoginRequest extends Request
{
    /**
     * Return the credentials
     *
     * @return array
     */
    public function getCredentials()
    {
        $login = $this->getLoginAttribute();

        return [
            $login => $this->get('login'),
            'password' => $this->get('password')
        ];
    }

    /**
     * Get login field configured by RainLab.User
     *
     * @return string
     */
    protected function getLoginAttribute()
    {
        return UserSettings::get('login_attribute', UserSettings::LOGIN_EMAIL);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => $this->getLoginAttribute() == UserSettings::LOGIN_USERNAME
                ? 'required|between:2,255'
                : 'required|email|between:6,255',
            'password' => 'required|between:4,255'
        ];
    }
}
