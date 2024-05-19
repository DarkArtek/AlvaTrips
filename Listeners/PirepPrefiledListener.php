<?php

namespace Modules\AlvaTrips\Listeners;

use App\Contracts\Listener;
use App\Events\PirepPrefiled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Modules\AlvaTrips\Models\Enums\TripState;
use Modules\AlvaTrips\Models\FlightPirepTrip;
use Modules\AlvaTrips\Models\TripReport;
use Illuminate\Database\Eloquent\Builder;

/**
 *  Class PirepPrefiledListener
 * @package Modules\AlvaTrips\Listeners
 */
class PirepPrefiledListener extends Listener
{
    /**
     *  Create the event listener
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
     * @param object $event
     * @return void
     */
    public function handle(PirepPrefiled $event)
    {
        // check if PIREP is associated with a trip
        $user = $event->pirep->user_id;
        $flight = $event->pirep->flight_id;
        $pirep_id = $event->pirep->id;

        try {
            $active_trip = TripReport::whereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user);
            })->whereIn('state', [TripState::UPCOMING, TripState::IN_PROGRESS])->whereHas('flights', function (Builder $query) use ($flight) {
                $query->where('flight_id', $flight);
            })->first();
            if ($active_trip === null) {
                return;
            }
            $active_trip->state = TripState::IN_PROGRESS;
            FlightPirepTrip::where(['trip_report_id' => $active_trip->id, 'flight_id' => $flight])->update(['pirep_id' => $pirep_id]);
            Log::info("Trip {$active_trip} paired with pirep {$pirep_id}");
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }
}
