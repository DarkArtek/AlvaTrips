<?php
namespace Modules\AlvaTrips\Providers;
use App\Events\PirepAccepted;
use App\Events\PirepFiled;
use App\Events\PirepPrefiled;
use App\Events\TestEvent;
use Modules\AlvaTrips\Listeners\PirepFiledListener;
use Modules\AlvaTrips\Listeners\PirepAcceptedListener;
use Modules\AlvaTrips\Listeners\PirepPrefiledListener;
use Modules\AlvaTrips\Listeners\TestEventListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Event listener mapping for the application.
     */
    protected $listen = [
        PirepPrefiled::class => [PirepPrefiledListener::class],
        PirepFiled::class    => [PirepFiledListener::class],
        PirepAccepted::class => [PirepAcceptedListener::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
