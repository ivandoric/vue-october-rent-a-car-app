<?php

namespace RLuders\JWTAuth\Http\Requests;

use RLuders\JWTAuth\Http\Requests\Request;

class ResetPasswordRequest extends Request
{
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
        return [
            'reset_password_code' => 'required',
            'password' => 'required|between:4,255:confirm'
            // @TODO Request Password Token Validation
        ];
    }
}
