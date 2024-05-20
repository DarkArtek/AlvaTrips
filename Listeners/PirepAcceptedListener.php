<?php

namespace Modules\AlvaTrips\Listeners;

use App\Contracts\Listener;
use App\Events\PirepAccepted;
use App\Models\Enums\PirepState;
use App\Models\Enums\PirepStatus;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\AlvaTrips\Events\TripCompleted;
use Modules\AlvaTrips\Models\Enums\TripState;
use Modules\AlvaTrips\Models\FlightPirepTrip;
use Modules\AlvaTrips\Models\TripReport;
use MongoDB\Driver\BulkWrite;

/**
 * Class PirepAcceptedListener
 * @package Modules\AlvaTrip\Listeners
 */
class PirepAcceptedListener extends Listener
{
    /**
     * Create the event listener
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the Event
     *
     * @param object $event
     *
     * @return void
     */
    public function handle(PirepAccepted $event)
    {
        $user = $event->pirep->user_id;
        $flight = $event->pirep->flight_id;
        $pirep_id = $event->pirep->id;

        // $active_trip = TripReport::whereHas('users', function ($q) use ($user) { $q->where('user_id', $user);})->whereIn('state', [TripState::UPCOMING, TripState::IN_PROGRESS])->whereHas('flights', function (Builder $query) use ($flight) {
        //    $query->where('flight_id', $flight);
        // })->with('fpts')->first();
        // dd($active_trip);
        // if ($active_trip === null) {
        //    return;
        // }

        // FlightPirepTrip::where(['trip_report_id' => $active_trip->id, 'flight_id' => $flight])->update(['completed' => true]);

        // Check for Trip Completion
        $ftp_f = FlightPirepTrip::with("trip_report")
            ->where("pirep_id", $pirep_id)
            ->first();
        if ($ftp_f === null) {
            return;
        }

        $active_trip = $ftp_f->trip_report()->first();
        $active_trip->load("ftps");
        // dd($active_trip);
        $completed = true;
        foreach ($active_trip->fpts as $fpt) {
            if ($fpt->pirep->state = PirepState::ACCEPTED) {
                continue;
            }
            $completed = false;
            break;
        }
        if ($completed) {
            // Trip completed.
            $active_trip->state = TripState::COMPLETED;
            $active_trip->save();
            // Delete user created flights.
            Flight::whereHasMorph("owner", [TripReport::class], function (Builder $builder) use ($active_trip) {
                $builder->where("owner_id", $active_trip->id);
            })->delete();

            // Trigger the Trip Completion Event.
            event(new TripCompleted($active_trip));
        }

    }
}
