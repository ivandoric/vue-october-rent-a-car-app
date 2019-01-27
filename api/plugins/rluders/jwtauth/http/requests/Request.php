<?php

namespace RLuders\JWTAuth\Http\Requests;

use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request as BaseRequest;

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
            return response()->json(
                [
                    'error' => $validator->getMessageBag()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return true;
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
