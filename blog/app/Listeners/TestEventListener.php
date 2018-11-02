<?php

namespace App\Listeners;

use Log;
use App\Events\TestEvent;
use App\Jobs\MyJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEventListener
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
     * @param  TestEvent  $event
     * @return void
     */
    public function handle(TestEvent $event)
    {
        //dispatch(new MyJob()); //add to Queue
        //Delayed Dispatching
        dispatch(new MyJob())->delay(now()->addMinutes(3));

        Log::info('=== TestEventListener  ========');
    }
}
