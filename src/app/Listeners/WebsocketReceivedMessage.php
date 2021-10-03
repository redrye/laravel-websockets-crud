<?php

namespace App\Listeners;

use \BeyondCode\LaravelWebSockets\Events\WebSocketMessageReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WebsocketReceivedMessage
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
     * @param  WebsocketReceivedMessage  $event
     * @return void
     */
    public function handle(WebSocketMessageReceived $event)
    {
        //
    }
}
