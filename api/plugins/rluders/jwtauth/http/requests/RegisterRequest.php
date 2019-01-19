<?php

namespace RLuders\JWTAuth\Http\Requests;

use RLuders\JWTAuth\Http\Requests\Request;
use RainLab\User\Models\Settings as UserSettings;

class RegisterRequest extends Request
{
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
     * {@inheritDoc}
     */
    public function data()
    {
        $data = $this->all();

        // Password confirmation is optional
        if (!array_key_exists('password_confirmation', $data)) {
            $data['password_confirmation'] = $data['password'];
        }

        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email'    => 'required|between:3,64|email|unique:users',
            'password' => 'required|between:4,64|confirmed',
        ];

        if ($this->getLoginAttribute() == UserSettings::LOGIN_USERNAME) {
            $rules['username'] = 'required|between:3,64|unique:users';
        }

        return $rules;
    }
}
