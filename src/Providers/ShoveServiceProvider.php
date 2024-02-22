<?php

namespace Shove\Queue;

use Illuminate\Support\ServiceProvider;

class ShoveServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $manager = $this->app['queue'];
        $manager->addConnector('shove', fn() => new ShoveConnector());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}