<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Facade de CoreGenerator
 * Codizer Core Social
 *
 * Class CoreGeneratorServiceProvider
 * @package App\Providers
 */
class CoreServiceProvider extends ServiceProvider
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
        \App::bind('core', function() {
           return new \App\Components\Core;
        });
    }
}
