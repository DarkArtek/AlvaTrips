<?php

namespace Modules\AlvaTrips\Listeners;

use App\Events\TestEvent;
use Illuminate\Support\Facades\Log;

/**
 * Simple event listener
 */

class TestEventListener
{
    /**
     * Handle the event
     *
     * @param \App\Events\TestEvent $event
     */
    public function handle(TestEvent $event)
    {
        Log::info('Received event', [$event]);
    }
}
