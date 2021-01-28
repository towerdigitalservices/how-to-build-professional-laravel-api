<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;

class CheckForNewDevice
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
     * @param  UserLogin  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $user = $event->user;
        // Some logic here to determine if the user is logged in using a new device
    }
}
