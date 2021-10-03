<?php

namespace Redrye\LaravelWebSocketsCrud\app\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		\BeyondCode\LaravelWebSockets\Events\NewConnection::class => [
			\App\Listeners\NewWebsocketConnection::class,
		],
		\BeyondCode\LaravelWebSockets\Events\ConnectionPonged::class => [
			\App\Listeners\WebsocketPong::class,
		],
		\BeyondCode\LaravelWebSockets\Events\ConnectionClosed::class => [
			\App\Listeners\WebsocketClose::class,
		],
		\BeyondCode\LaravelWebSockets\Events\SubscribedToChannel::class => [
			\App\Listeners\WebsocketSubscribed::class,
		],
		\BeyondCode\LaravelWebSockets\Events\UnsubscribedFromChannel::class => [
			\App\Listeners\WebsocketUnsubscribed::class,
		],
		\BeyondCode\LaravelWebSockets\Events\WebSocketMessageReceived::class => [
			\App\Listeners\WebsocketReceivedMessage::class
		]
	];


	/**
	 * Register any other events for your application.
	 *
	 * @param  Dispatcher $events
	 * @return void
	 */
	public function boot()
	{
		parent::boot();
	}
}
