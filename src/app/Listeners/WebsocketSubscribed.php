<?php

namespace App\Listeners;

use App\Events\NewMessageNotification;
use App\Jobs\TestJob;
use Redrye\LaravelWebSocketsCrud\app\Models\User;
use \BeyondCode\LaravelWebSockets\Events\SubscribedToChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class WebsocketSubscribed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SubscribedToChannel  $event
     * @return void
     */
    public function handle(SubscribedToChannel $event)
    {
//        NewMessageNotification::dispatch(User::find(2));
    }
}
