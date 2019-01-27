<?php namespace Octobro\API;

use App;
use Config;
use System\Classes\PluginBase;
use Illuminate\Foundation\AliasLoader;

class Plugin extends PluginBase
{
    public function boot()
    {
        // Register Cors
        App::register('\Barryvdh\Cors\ServiceProvider');

        // Add cors middleware
        app('router')->aliasMiddleware('cors', \Barryvdh\Cors\HandleCors::class);
        
    }
}
