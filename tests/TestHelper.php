<?php

namespace Tests;
use App\Models\User;
use App\Models\Role;
use Mockery;
use Illuminate\Support\Facades\Auth;
use App\Contracts\PhoneService;

class TestHelper
{
    public function __construct($app)
    {
        $this->app = $app;
    }
    public function user($role = null)
    {
        $user =  User::factory()->make();

        if(!empty($role)) {
            $user->assignRole($role);
        }
        $user->save();
        return $user;
    }

    public function login(User $user)
    {
        Auth::login($user);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function role()
    {
        return Role::factory()->create();
    }

    public function userWithPhone($role = null)
    {
        $user = $this->user($role);
        $user->phones()->create([
            'twilio_phone_id' => 'abcxyz123',
            'twilio_phone_number' => '+15555555555'
        ]);
        return $user;
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
