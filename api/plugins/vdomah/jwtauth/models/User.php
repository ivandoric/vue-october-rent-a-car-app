<?php namespace Vdomah\JWTAuth\Models;

use RainLab\User\Models\User as UserBase;

class User extends UserBase implements \Illuminate\Contracts\Auth\Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
}