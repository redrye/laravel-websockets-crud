<?php

namespace App\Listeners;

use \BeyondCode\LaravelWebSockets\Events\NewConnection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class NewWebsocketConnection
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
     * @param  NewConnection  $event
     * @return void
     */
    public function handle(NewConnection $event)
    {
    //    Log::debug('hello world');
    }
}
