<?php

namespace RLuders\JWTAuth\Exceptions;

use Illuminate\Http\Response;
use InvalidArgumentException;
use October\Rain\Exception\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class JsonValidationException extends ValidationException implements HttpExceptionInterface
{
    public function getStatusCode()
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    public function getHeaders()
    {
        return [
            'Content-tye' => 'application/json;charset=UTF-8'
        ];
    }

    public function toArray()
    {
        return ['errors' => $this->getErrors()];
    }
}