<?php

namespace RLuders\JWTAuth\Classes;

use RainLab\User\Classes\AuthManager as RainAuthManager;

/**
 * {@inheritDoc}
 */
class AuthManager extends RainAuthManager
{
    /**
     * {@inheritDoc}
     */
    protected $userModel = \RLuders\JWTAuth\Models\User::class;
}
