<?php

namespace App\Listeners;

use App\Events\ThreadCreated;
use Illuminate\Queue\InteractsWithQueue;
// Specify this listener should be send to a queue
use Illuminate\Contracts\Queue\ShouldQueue;

//class CheckForSpam
// Specify this listener should be send to a queue
class CheckForSpam implements ShouldQueue
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
     * @param  ThreadCreated  $event
     * @return void
     */
    public function handle(ThreadCreated $event)
    {
        var_dump('Checking for spam');
    }
}
