<?php

namespace Modules\AlvaTrips\Models\Enums;

use App\Contracts\Enum;

class TripState extends Enum
{
    public const UPCOMING = 0;
    public const IN_PROGRESS = 1; // ongoing flight.
    public const COMPLETED = 2; // waiting admin approval.
    public const CANCELLED = 3;

    protected static array $labels = [
        self::UPCOMING    => 'trips.state.upcoming',
        self::IN_PROGRESS => 'trips.state.in_progress',
        self::COMPLETED   => 'trips.state.completed',
        self::CANCELLED   => 'trips.state.cancelled'
    ];
}
