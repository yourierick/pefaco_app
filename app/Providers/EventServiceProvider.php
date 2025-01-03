<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */

     protected $listen = [
        \App\Events\ObjectDeleted::class => [\App\Listeners\DeleteCustomSystemNotifications::class,],
     ];

    /**
     * m.Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }
}
