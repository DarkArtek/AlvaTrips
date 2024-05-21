<?php
namespace Modules\AlvaTrips\tests;

use App\Models\Flight;
use App\Models\Pirep;
use App\Services\BidService;
use App\Services\FlightService;
use App\Services\PirepService;
use Modules\AlvaTrips\Models\Enums\TripState;
use Modules\AlvaTrips\Models\FlightPirepTrip;
use Modules\AlvaTrips\Models\TripReport;
use Modules\AlvaTrips\Services\AlvaTripsService;
use Tests\TestCase;

class TripManagementTest extends TestCase
{
    protected AlvaTripsService $tripsService;
    protected PirepService $pirepService;
    protected FlightService $flightService;
    protected BidService $bidsService;
    protected TripReport $testTrip;

    protected array $trip_case = [
        'name'        => "Free Flight",
        'description' => "Flight Description",
        'user_id'     => 1,
        'flights'     => [
            [
                'airline_id'     => 1,
                'flight_number'  => '1521',
                'route_leg'      => 1,
                'dpt_airport_id' => 'EIDW',
                'arr_airport_id' => 'LIPZ',
                'minutes'        => 0,
                'hours'          => 0
            ],
            [
                'airline_id'     => 1,
                'flight_number'  => '1521',
                'route_leg'      => 1,
                'dpt_airport_id' => 'LIPZ',
                'arr_airport_id' => 'EIDW',
                'minutes'        => 0,
                'hours'          => 0
            ]
        ]
    ];
    public function setUp(): void
    {
        parent::setUp();
        $this->addData('base');
        $this->tripsService = $this->app(AlvaTripsService::class);
        $this->flightService = $this->app(FlightService::class);
        $this->pirepService = $this->app(PirepService::class);
    }

    public function createTrip()
    {
        // Setup Trip Fields
        $fields = $this->trip_case;

        // Test Procedure
        $trip = $this->tripsService->createNewTrip($fields);

        // Test trip created
        $this->assertModelExists($trip);

        // Test flight created
        $flights = Flight::where(['flight_number' => 1521])->get();
        $this->assertCount(2, $flights);

        // Test flights attached to Trip
        $this->assertCount(2, $trip->flights);

        $this->testTrip = $trip;
    }

    public function testAdvanceTripProgress()
    {
        // Setup
        $trip = $this->tripsService->createNewTrip($this->trip_case);

        // Create and submit first pirep for trip.
        $pirep = Pirep::fromFlight($trip->flights()->first());
        $pirep->user_id = 1;
        $pirep->save();
        $this->pirepService->submit($pirep);

        // Check if PIREP attached to Pivot Table
        $fpt = FlightPirepTrip::where(['pirep_id' => $pirep->id])->first();
        $this->assertNull($fpt);
    }

    public function testCompleteTrip()
    {
        // Setup
        $trip = $this->tripsService->createNewTrip($this->trip_case);

        //foreach leg, file a pirep
        foreach ($trip->fpts as $fpt) {
            $pirep = Pirep::fromFlight(Flight::find($fpt->flight_id));
            $pirep->user_id = 1;
            $pirep->save();
            $this->pirepService->submit($pirep);
        }

        // Once this happens all trip completion events should fire. Check for trip completion
        $trip->refresh();
        $this->assertEquals(TripState::COMPLETED, $this->testTrip->state);
        $this->assertCount(0, $this->testTrip->flights);
    }
}
