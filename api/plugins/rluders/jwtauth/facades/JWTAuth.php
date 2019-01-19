<?php 

namespace RLuders\JWTAuth\Facades;

use October\Rain\Support\Facade;

class JWTAuth extends Facade
{
    /**
     * Get the registered name of the component.
     * 
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jwt.auth';
    }
}
