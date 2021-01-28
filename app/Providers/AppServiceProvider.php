<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\PhoneService;
use App\Services\Twilio;

class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        PhoneService::class => Twilio::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PhoneService::class, function ($app) {
            switch(config('phone.service')){
                case 'twilio':
                    $provider = $app->make(Twilio::class);
                    break;
                case 'some-other-service':
                    // $provider = $app->make(SomeOtherService::class);
                    break;
                }
            return $provider;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
