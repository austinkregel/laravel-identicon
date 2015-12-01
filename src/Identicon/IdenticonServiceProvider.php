<?php

namespace Kregel\Identicon;

use Illuminate\Support\ServiceProvider;

class IdenticonServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('identicon', function () {
            return new \Identicon\Identicon;
        });
        $this->app->alias('identicon', Facades\Identicon::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            if (! $this->app->routesAreCached()) {
                require __DIR__.'/Http/routes.php';
            }
        });
        $this->publishes([
           __DIR__.'/../config/config.php' => config_path('kregel/identicon.php')
        ], 'config');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
