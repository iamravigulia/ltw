<?php

namespace edgewizz\ltw;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LtwServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Edgewizz\Ltw\Controllers\LtwController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // dd($this);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__ . '/components', 'ltw');
        Blade::component('ltw::ltw.open', 'ltw.open');
        Blade::component('ltw::ltw.index', 'ltw.index');
        Blade::component('ltw::ltw.edit', 'ltw.edit');
    }
}
