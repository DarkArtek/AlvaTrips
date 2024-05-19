<?php

namespace Modules\AlvaTrips\Models;

use App\Contracts\Model;
use App\Models\Flight;
use App\Models\Pirep;
use App\Models\Traits\HashIdTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class TripReport
 * @package Modules\AlvaTrips\Models
 * @property int state
 * @property string id
 * @property string name
 */
class TripReport extends Model
{
    use HashIdTrait;
    public $table = 'alva_trip_reports';
    protected $keyType = 'string';
    public $incrementing = false;

    public function parent(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'trip_report_user')->withPivot('owner');
    }

    public function fpts()
    {
        return $this->belongsToMany(FlightPirepTrip::class);
    }

    public function pireps()
    {
        return $this->belongsToMany(Pirep::class, 'alva_flight_pirep_trip')->withPivot('order');
    }

    public function flights()
    {
        return $this->belongsToMany(Flight::class, 'alva_flight_pirep_trip')->withPivot('order');
    }

    protected $casts = [];

    public static $rules = [];
}
