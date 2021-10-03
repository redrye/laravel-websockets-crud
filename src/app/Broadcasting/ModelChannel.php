<?php

namespace Redrye\LaravelWebSocketsCrud\app\Broadcasting;

use Redrye\LaravelWebSocketsCrud\app\Models\User;
use BeyondCode\LaravelWebSockets\Server\Loggers\ConnectionLogger;

class ModelChannel
{
	/**
	 * Create a new channel instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Authenticate the user's access to the channel.
	 *
	 * @param  \Redrye\LaravelWebSocketsCrud\app\Models\User  $user
	 * @return array|bool
	 */
	public function join(User $user, $model, $id)
	{
		$model =  'App\Models\\' . $model;
		return $user->can('view',  $model::find($id));
	}

	private function UserJoin(User $user, $id) {
		return $user->id == $id;
	}

	private function DriverJoin(User $user, $id) {
		return $this->modelJoin($user, 'Driver', $id) || $user->id == Driver::find($id)->users_id;
	}

	private function modelJoin(User $user, $model, $id) {
		return $user->isAdmin() || $user->motorCarrier->id == $model::find($id)->motorCarrier->id;
	}
}
