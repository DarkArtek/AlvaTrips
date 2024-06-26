<?php

namespace Modules\AlvaTrips\Models;

use App\Contracts\Model;
use App\Models\Flight;
use App\Models\Pirep;

/**
 *  Class FlightPirepTrip
 * @package Modules\AlvaTrips\Models
 */
class FlightPirepTrip extends Model
{
    public $table = 'alva_flight_pirep_trip';
    protected $fillable = ['id', 'trip_report_id', 'flight_id', 'pirep_id', 'order'];
    public $timestamps = false;

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function trip_report()
    {
        return $this->belongsTo(TripReport::class);
    }

    public function pirep()
    {
        return $this->belongsTo(Pirep::class);
    }
}
