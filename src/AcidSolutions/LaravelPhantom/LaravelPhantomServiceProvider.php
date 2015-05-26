<?php namespace AcidSolutions\LaravelPhantom;

use Illuminate\Support\ServiceProvider;

class LaravelPhantomServiceProvider extends ServiceProvider {

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
		$this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('PdfPhantom', 'AcidSolutions\LaravelPhantom\PdfPhantom');
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('pdfphantom');
	}

}
