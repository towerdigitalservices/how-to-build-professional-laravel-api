<?php

namespace App\Providers;

use App\Events\UserSignedUp;
use App\Events\UserLoggedIn;
use App\Listeners\CheckForNewDevice;
use App\Listeners\SendWelcomeEmail;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserSignedUp::class => [
            SendWelcomeEmail::class,
        ],
        UserLoggedIn::class => [
            CheckForNewDevice::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
