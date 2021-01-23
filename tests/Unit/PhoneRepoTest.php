<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Repositories\PhoneRepository;

class PhoneRepoTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @group phone
     */
    public function phone_resource_is_created_when_phone_is_provisioned()
    {
        $user = $this->helper->user('user');
        $this->helper->mockPhoneService();
        $repo = app()->make(PhoneRepository::class);
        $repo->provisionPhone('+15555555555', $user);
        $this->assertDatabaseCount('phones', 1);
    }
    /**
     * @test
     * @group phone
     */
    public function phone_resource_is_removed_when_phone_is_removed()
    {
        $user = $this->helper->user('user');
        $phone = $user->phones()->create([
            'twilio_phone_id' => 'abcxyz123',
            'twilio_phone_number' => '+15555555555'
        ]);
        $this->assertDatabaseCount('phones', 1);

        $this->helper->mockPhoneService();
        $repo = app()->make(PhoneRepository::class);
        $repo->removePhone($phone->id);
        $this->assertDatabaseCount('phones', 0);
    }
}
