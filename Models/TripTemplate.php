<?php

namespace Modules\AlvaTrips\Models;

use App\Contracts\Model;

/**
 * Class TripTemplate
 * @package Modules\AlvaTrips\Models
 */
class TripTemplate extends Model
{
    public $table = 'alva_trip_templates';
    protected $fillable = ['name', 'description', 'type', 'data'];

    public function trip_reports()
    {
        return $this->morphMany(TripReport::class, 'parent');
    }
}
