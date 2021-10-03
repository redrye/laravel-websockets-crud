<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Event implements ShouldBroadcastNow {

	use Dispatchable, InteractsWithSockets, SerializesModels;

	var $model = '';

	protected $privateChannels = [];
	protected $presestenceChannels = [];

	function __construct($model, $event)
	{
		$this->model = $model;
		$this->event = $event;
		$this->privateChannels = [
			new PrivateChannel('Admin'),
			new PrivateChannel('MotorCarrier.' . $this->model->carriers_id),
			new PrivateChannel(class_basename($this->model) . '.' . $this->model->id)
		];
	}

	public function broadcastAs() {
		return $this->event;
	}

	public function broadcastOn()
	{
		return array_merge(
			$this->privateChannels,
			$this->presestenceChannels
		);
	}
}
