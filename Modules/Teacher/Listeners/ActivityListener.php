<?php

namespace Modules\Teacher\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;
use Modules\Teacher\Events\ActivityEvent;

class ActivityListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(ActivityEvent $event)
    {
        Redis::publish('test-radis-channel', json_encode([
            'data' => $event->data
        ]));
    }
}
