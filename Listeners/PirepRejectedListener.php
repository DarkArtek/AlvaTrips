<?php
namespace Modules\AlvaTrips\Listeners;

use App\Contracts\Listener;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * class PirepRejectedListener
 * @package Modules\AlvaTrips\Listeners
 */
class PirepRejectedListener extends Listener
{
    /**
     * Create the listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
