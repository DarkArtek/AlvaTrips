<?php

namespace Modules\AlvaTrips\Events;

use App\Contracts\Event;
use Illuminate\Queue\SerializesModels;
use Modules\AlvaTrips\Models\TripReport;

/**
 *  Class TripCompleted
 *  @package Modules\AlvaTrips\Events
 */

class TripCompleted extends Event
{
    use SerializesModels;

    /**
     *  Creates a new event instance.
     *
     * @return void
     */
    public function __construct(public TripReport $tripReport)
    {
        //
    }

    /**
     *  Get the channels where the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
