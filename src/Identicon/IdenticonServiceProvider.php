<?php namespace Kregel\Identicon;

use Illuminate\Support\ServiceProvider;

class IdenticonServiceProvider extends ServiceProvider {

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
		$this->app->bind('identicon', function(){
			return new \Identicon\Identicon;
		});
		$this->app->alias('identicon', Identicon\Identicon::class);
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
	    $this->app->booted(function () {
	        $this->defineRoutes();
	    });
	}
	/**
	 * Define the UserManagement routes.
	 *
	 * @return void
	 */
  protected function defineRoutes()
  {
      if (! $this->app->routesAreCached()) {
          require __DIR__.'/Http/routes.php';
      }
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
