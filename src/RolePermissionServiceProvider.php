<?php

namespace LaraPack\RolePermission;

class RolePermissionServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'larapack');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



    }

    public function register()
    {
        $this->publishes([
            __DIR__.'/assets/js' => public_path('admin/js'),
        ], 'assets');
    }

}
