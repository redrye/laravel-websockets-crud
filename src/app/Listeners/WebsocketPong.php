<?php

namespace App\Listeners;

use \BeyondCode\LaravelWebSockets\Events\ConnectionPonged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WebsocketPong
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
     * @param  ConnectionPonged  $event
     * @return void
     */
    public function handle(ConnectionPonged $event)
    {
        //
    }
}
