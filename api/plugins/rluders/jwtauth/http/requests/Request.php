<?php

namespace RLuders\JWTAuth\Http\Requests;

use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request as BaseRequest;
use RLuders\JWTAuth\Exceptions\JsonValidationException;

abstract class Request extends BaseRequest
{
    /**
     * Validate the request
     *
     * @return boolean|Response
     */
    public function validate()
    {
        $validator = Validator::make($this->data(), $this->rules());
        if ($validator->fails()) {
            throw new JsonValidationException($validator);
        }
    }

    /**
     * The data that will be validated
     *
     * @return array
     */
    public function data()
    {
        return $this->all();
    }

    /**
     * Validation rules
     *
     * @return array
     */
    abstract public function rules();
}