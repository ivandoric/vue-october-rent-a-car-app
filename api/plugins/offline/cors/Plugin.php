<?php namespace OFFLINE\CORS;

use OFFLINE\CORS\Classes\HandleCors;
use OFFLINE\CORS\Classes\HandlePreflight;
use OFFLINE\CORS\Classes\ServiceProvider;
use OFFLINE\CORS\Models\Settings;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function boot()
    {
        \App::register(ServiceProvider::class);

        $this->app['Illuminate\Contracts\Http\Kernel']
            ->prependMiddleware(HandleCors::class);

        if (request()->isMethod('OPTIONS')) {
            $this->app['Illuminate\Contracts\Http\Kernel']
                ->prependMiddleware(HandlePreflight::class);
        }
    }

    public function registerPermissions()
    {
        return [
            'offline.cors.manage' => [
                'label' => 'Can manage cors settings',
                'tab'   => 'CORS',
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'cors' => [
                'label'       => 'CORS-Settings',
                'description' => 'Manage CORS headers',
                'category'    => 'system::lang.system.categories.cms',
                'icon'        => 'icon-code',
                'class'       => Settings::class,
                'order'       => 500,
                'keywords'    => 'cors',
                'permissions' => ['offline.cors.manage'],
            ],
        ];
    }
}
