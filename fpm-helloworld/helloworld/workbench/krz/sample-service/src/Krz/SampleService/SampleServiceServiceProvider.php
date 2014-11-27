<?php namespace Krz\SampleService;

use Illuminate\Support\ServiceProvider;

class SampleServiceServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('krz/sample-service');

		$this->app->bind('krz::sampleservice.createjobs', function($app) {
		    return new CreateJobsCommand();
		});
		$this->commands(array(
		    'krz::sampleservice.createjobs'
		));
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
