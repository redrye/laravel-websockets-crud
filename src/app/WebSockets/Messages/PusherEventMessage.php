<?php


namespace Redrye\LaravelWebSocketsCrud\app\WebSockets\Messages;


use BeyondCode\LaravelWebSockets\Contracts\ChannelManager;
use BeyondCode\LaravelWebSockets\Contracts\PusherMessage;
use BeyondCode\LaravelWebSockets\DashboardLogger;
use BeyondCode\LaravelWebSockets\Events\ConnectionPonged;
use BeyondCode\LaravelWebSockets\Server\Messages\PusherChannelProtocolMessage;
use BeyondCode\LaravelWebSockets\Server\Messages\PusherClientMessage;
use Illuminate\Support\Str;
use Log;
use Ratchet\ConnectionInterface;
use stdClass;

class PusherEventMessage extends PusherClientMessage
{

	public function __call($method, $param1) {

		$class = 'App\\Events\\' . $method . 'Event';
		event(new $class($param1[0]));
	}
	/**
	 * Respond with the payload.
	 *
	 * @return void
	 */
	public function respond()
	{
			$this->{$this->payload->event}($this->payload->data);
	}

	/**
	 * Ping the connection.
	 *
	 * @see    https://pusher.com/docs/pusher_protocol#ping-pong
	 * @param  \Ratchet\ConnectionInterface  $connection
	 * @return void
	 */
	protected function ping(ConnectionInterface $connection)
	{
		$this->channelManager
			->connectionPonged($connection)
			->then(function () use ($connection) {
				$connection->send(json_encode(['event' => 'pusher:pong']));

				ConnectionPonged::dispatch($connection->app->id, $connection->socketId);
			});
	}


}
