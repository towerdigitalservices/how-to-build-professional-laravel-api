<?php

namespace Tests;
use App\Models\User;
use App\Models\Role;
use Mockery;
use App\Services\Contracts\PhoneService;

class TestHelper
{
    public function __construct($app)
    {
        $this->app = $app;
    }
    public function user($role = null)
    {
        $user =  User::factory()->create();

        if(!empty($role)){
            $user->assignRole($role);
            $user->save();
        }
        return $user;
    }

    public function role()
    {
        return Role::factory()->create();
    }

    public function phone()
    {
        return Role::factory()->make();
    }

    public function mockPhoneService()
    {
        $phone = Mockery::mock(PhoneService::class);
        $phone->shouldReceive('searchAvailableNumbers')
            ->andReturn([
                ['friendly_name' => '(555) 555-5555'],
                ['friendly_name' => '(555) 555-5555'],
                ['friendly_name' => '(555) 555-5555']
            ]);
        $phone->shouldReceive('provisionNumber')
            ->andReturn([
                'twilio_phone_number' => '+15555555555',
                'twilio_phone_id' => 'abcxyz1234',
            ]);
        $phone->shouldReceive('removeNumber');
        $phone->shouldReceive('sendMessage')
            ->andReturn([
                'id' => 'abcxyz1234',
                'message' => 'test message',
            ]);
        $this->app->instance(PhoneService::class, $phone);
    }
}
