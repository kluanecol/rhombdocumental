<?php

namespace App\Modules\Admin\Permission\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Admin\Permission\Repository\PermissionRepository;
use App\Modules\Admin\Permission\Repository\PermissionInterface;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PermissionInterface::class, function($app)
        {
            return new PermissionRepository;
        });
    }
}
