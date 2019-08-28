<?php

namespace App\Listeners;

use App\Events\ServiceEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class ServiceListener
{
    /**
     * Create the event listener.
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
     * @param  ServiceEvent  $event
     * @return void
     */
    public function handle(ServiceEvent $event)
    {
        return $event;
    }
}
