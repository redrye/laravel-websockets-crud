<?php

namespace Redrye\LaravelWebSocketsCrud\app\Providers;

use Illuminate\Broadcasting\BroadcastServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->register(BroadcastServiceProvider::class);
	}
}
