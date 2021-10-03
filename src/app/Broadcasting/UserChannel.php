<?php

namespace App\Broadcasting;

use Redrye\LaravelWebSocketsCrud\app\Models\User;
use Auth;
use BeyondCode\LaravelWebSockets\Channels\PrivateChannel;
use Ratchet\ConnectionInterface;
use stdClass;

class UserChannel
{

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \Redrye\LaravelWebSocketsCrud\app\Models\User  $user
     * @return array|bool
     */
    public function join(User $user, $id)
    {
        return $user->id == $id;
    }


}
