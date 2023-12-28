<?php

namespace App\Modules\Admin\Role\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Admin\Role\Repository\RoleRepository;
use App\Modules\Admin\Role\Repository\RoleInterface;

class RoleServiceProvider extends ServiceProvider
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
        $this->app->bind(RoleInterface::class, function($app)
        {
            return new RoleRepository;
        });
    }
}
