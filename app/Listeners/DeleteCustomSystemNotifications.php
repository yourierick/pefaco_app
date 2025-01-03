<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\ObjectDeleted;
use Illuminate\Support\Facades\DB;

class DeleteCustomSystemNotifications
{
    /**
     * Create the event listener.
     *
     * @param ObjectDeleted $event
     * @return void
     */


    /**
     * Handle the event.
     */
    public function handle(ObjectDeleted $event): void
    {
        $object = $event->object;

        DB::table('notifications')
            ->whereJsonContains('data->object_id', $object->id)
            ->whereJsonContains('data->object_type', get_class($object))->delete();
    }
}
