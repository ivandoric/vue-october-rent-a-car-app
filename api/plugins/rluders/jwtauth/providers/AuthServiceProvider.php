<?php

namespace RLuders\JWTAuth\Providers;

use Config;
use RainLab\User\Models\User;
use Tymon\JWTAuth\Providers\AbstractServiceProvider;
use RLuders\JWTAuth\Models\Settings as PluginSettings;

class AuthServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->bindResponses();
        $this->loadConfiguration();
        $this->aliasMiddleware();
    }

    /**
     * Binding the requests that works almost like the Laravel FormRequests
     *
     * @return void
     */
    protected function bindResponses()
    {
        $this->app->bind(
            \RLuders\JWTAuth\Http\Requests\TokenRequest::class,
            function ($app) {
                return new \RLuders\JWTAuth\Http\Requests\TokenRequest(input());
            }
        );

        $this->app->bind(
            \RLuders\JWTAuth\Http\Requests\LoginRequest::class,
            function ($app) {
                return new \RLuders\JWTAuth\Http\Requests\LoginRequest(input());
            }
        );

        $this->app->bind(
            \RLuders\JWTAuth\Http\Requests\ActivationRequest::class,
            function ($app) {
                return new \RLuders\JWTAuth\Http\Requests\ActivationRequest(input());
            }
        );

        $this->app->bind(
            \RLuders\JWTAuth\Http\Requests\ForgotPasswordRequest::class,
            function ($app) {
                return new \RLuders\JWTAuth\Http\Requests\ForgotPasswordRequest(input());
            }
        );

        $this->app->bind(
            \RLuders\JWTAuth\Http\Requests\RegisterRequest::class,
            function ($app) {
                return new \RLuders\JWTAuth\Http\Requests\RegisterRequest(input());
            }
        );

        $this->app->bind(
            \RLuders\JWTAuth\Http\Requests\ResetPasswordRequest::class,
            function ($app) {
                return new \RLuders\JWTAuth\Http\Requests\ResetPasswordRequest(input());
            }
        );

        // Resolving the bindings above and validating it
        $this->app->resolving(
            \RLuders\JWTAuth\Http\Requests\Request::class,
            function ($api, $app) {
                $result = $api->validate();
                if ($result !== true) {
                    $result->send();
                }
            }
        );
    }

    /**
     * Load JWT Configuration
     *
     * @return void
     */
    protected function loadConfiguration()
    {
        // Some of default values that doesn't need to be configured by
        // the user are included on this file
        Config::set('jwt', include realpath(__DIR__ . '/../config/jwt.php'));

        $attributes = PluginSettings::instance()->attributes;
        foreach ($attributes as $attr => $value) {
            $config = 'jwt.' . str_replace('keys_', 'keys.', $attr);

            if ($config == 'jwt.required_claims'
                || $config == 'jwt.persistent_claims'
            ) {
                $value = explode(' ', $value);
            }

            if ($config == 'jwt.decrypt_cookies') {
                // This is confusing. 'Cause it should be an inverse logic.
                $value = !$value;
            }

            $isInteger = in_array(
                $config,
                [
                    'jwt.ttl',
                    'jwt.refresh_ttl',
                    'jwt.leeway',
                    'jwt.blacklist_grace_period'
                ]
            );
            if ($isInteger) {
                $value = (int)$value;
            }

            Config::set($config, $value);
        }
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
        $router = $this->app['router'];

        $method = method_exists($router, 'aliasMiddleware')
            ? 'aliasMiddleware'
            : 'middleware';

        foreach ($this->middlewareAliases as $alias => $middleware) {
            $router->$method($alias, $middleware);
        }
    }
}
