<?php

namespace App\Modules\Files\Document\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Files\Document\Repository\DocumentRepository;
use App\Modules\Files\Document\Repository\DocumentInterface;

class DocumentServiceProvider extends ServiceProvider
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
        $this->app->bind(DocumentInterface::class, function($app)
        {
            return new DocumentRepository;
        });
    }
}
