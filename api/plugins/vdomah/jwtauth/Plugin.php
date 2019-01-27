<?php namespace Vdomah\JWTAuth;

use RainLab\User\Models\User;
use System\Classes\PluginBase;
use App;
use Illuminate\Foundation\AliasLoader;

class Plugin extends PluginBase
{
    /**
     * @var array   Require the RainLab.User plugin
     */
    public $require = ['RainLab.User'];

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        $this->app->bind(\Illuminate\Auth\AuthManager::class, function($app){
            return new \Illuminate\Auth\AuthManager($app);
        });

        App::register('\Vdomah\JWTAuth\Classes\JWTAuthServiceProvider');

        $facade = AliasLoader::getInstance();
        $facade->alias('JWTAuth', '\Tymon\JWTAuth\Facades\JWTAuth');
        $facade->alias('JWTFactory', '\Tymon\JWTAuth\Facades\JWTFactory');

        App::singleton('auth', function ($app) {
            return new \Illuminate\Auth\AuthManager($app);
        });

        $this->app['router']->middleware('jwt.auth', '\Tymon\JWTAuth\Middleware\GetUserFromToken');
        $this->app['router']->middleware('jwt.refresh', '\Tymon\JWTAuth\Middleware\RefreshToken');

        User::extend(function($model) {
            $model->addDynamicMethod('getAuthApiAttributes', function () {
                return [];
            });
        });
    }
}
