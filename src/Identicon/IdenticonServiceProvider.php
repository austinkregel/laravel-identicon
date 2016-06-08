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
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        // Register the alias.
        $loader->alias('Identicon', \Identicon\Identicon::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->app->booted(function () {
            if (!$this->app->routesAreCached() && !config('kregel.identicon.local-routes')) {
                require __DIR__.'/Http/routes.php';
            }
        });
        $this->publishes([
           __DIR__.'/../config/config.php' => config_path('kregel/identicon.php'),
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
