<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//


use Redrye\LaravelWebSocketsCrud\app\Broadcasting\ModelChannel;
use Illuminate\Support\Facades\Broadcast;

/* Private Channel Routes */
Broadcast::channel('{model}.{id}', ModelChannel::class);

