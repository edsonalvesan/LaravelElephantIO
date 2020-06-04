<?php
namespace EdsonAlvesan\LaravelElephant;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version1X;
use EdsonAlvesan\LaravelElephant\LaraElephantIO;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ElephantServiceProvider extends BaseServiceProvider
{
	/**
	 * Bootstrap the service provider.
	 *
	 * @return void
	 */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/config/elephant-io.php' => config_path('elephant-io.php'),
        ], 'config');
    }

    /**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
    {
    	$this->app->singleton('elephant.io', function($app){
            $config = $app['config']->get('elephant-io');

            $options = array('debug' => $config['debug']);

            return new Client(new Version1X($config['url'], $options));
        });

        $this->app->singleton('laravel.elephantio', function($app){
            return new LaraElephantIO($app['elephant.io']);
        });
    }
}