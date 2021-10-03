<?php

namespace App\Listeners;

use App\Events\BeyondCode\LaravelWebSockets\Events\ConnectionClosed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WebsocketClose
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
     * @param  ConnectionClosed  $event
     * @return void
     */
    public function handle(ConnectionClosed $event)
    {
        //
    }
}
