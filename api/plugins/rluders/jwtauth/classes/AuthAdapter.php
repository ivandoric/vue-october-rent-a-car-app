<?php

namespace RLuders\JWTAuth\Classes;

use October\Rain\Auth\AuthException;
use RLuders\JWTAuth\Classes\AuthManager;
use Tymon\JWTAuth\Contracts\Providers\Auth as AuthInterface;

/**
 * {@inheritDoc}
 */
class AuthAdapter implements AuthInterface
{
    /**
     * @var RLuders\JWTAuth\Classes\AuthManager
     */
    protected $auth;

    /**
     * Construct the adapter
     */
    public function __construct()
    {
        $this->auth = AuthManager::instance();
    }

    /**
     * Get user by credentials
     *
     * @param array $credentials User credentials (username/email and password)
     *
     * @return bool|RLuders\JWTAuth\Models\User
     */
    public function byCredentials(array $credentials = [])
    {
        try {
            $user = $this->auth->findUserByCredentials($credentials);
            $this->auth->setUser($user);

            return $user;
        } catch (AuthException $e) {
            return false;
        }
    }

    /**
     * Authenticate a user via the id.
     *
     * @param mixed $id The user ID
     *
     * @return bool
     */
    public function byId($id)
    {
        if (!is_null($user = $this->auth->findUserById($id))) {
            $this->auth->setUser($user);
        }

        return $user;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return RLuders\JWTAuth\Models\User
     */
    public function user()
    {
        return $this->auth->getUser();
    }

    /**
     * Register user
     *
     * @param array $data
     * @param boolean $activate
     * @return October\Rain\Database\Model
     */
    public function register($data, $activate = false)
    {
        return $this->auth->register($data, $activate);
    }
}
