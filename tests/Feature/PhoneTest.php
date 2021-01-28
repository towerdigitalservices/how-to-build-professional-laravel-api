<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PhoneTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @group phone
     */
    public function managers_can_provision_new_phones()
    {
        $manager = $this->helper->user('manager');
        $input = [
            'phone_number' => '5555555555',
            'user_id' => $manager->id
        ];
        $this->helper->mockPhoneService();
        $this->actingAs($manager)
            ->json('POST', route('provision-phone'), $input)
            ->assertStatus(200);
        $this->assertDatabaseCount('phones', 1);
    }

    /**
     * @test
     * @group phone
     */
    public function managers_can_delete_phones()
    {
        $manager = $this->helper->userWithPhone('manager');
        $phone = $manager->phones->first();
        $this->actingAs($manager)
            ->json('DELETE', route('delete-phone',$phone->id))
            ->assertStatus(200);
    }

    /**
     * @test
     * @group phone
     */
    public function users_cannot_create_or_delete_phones()
    {
        $user = $this->helper->user();
        $input = [
            'phone_number' => '5555555555',
            'user_id' => $user->id
        ];
        $this->helper->mockPhoneService();
        $this->actingAs($user)
            ->json('POST', route('provision-phone'), $input)
            ->assertStatus(403);

        $user = $this->helper->userWithPhone();
        $phone = $user->phones->first();
        $this->actingAs($user)
            ->json('DELETE', route('delete-phone',$phone->id))
            ->assertStatus(403);
    }

    /**
     * @test
     * @group phone
     */
    public function users_can_send_sms_messages_for_phones_they_own()
    {
        $user = $this->helper->userWithPhone();
        $phone = $user->phones->first();
        $input = [
            'to_number' => '+15555555555',
            'message' => 'Test Message'
        ];
        $this->helper->mockPhoneService();
        $this->actingAs($user)
            ->json('POST', route('send-message',$phone->id), $input)
            ->assertStatus(200);
    }

    /**
     * @test
     * @group phone
     */
    public function users_cannot_send_sms_messages_for_phones_they_dont_own()
    {
        $user = $this->helper->user();
        $other = $this->helper->userWithPhone();
        $phone = $other->phones->first();
        $input = [
            'to_number' => '+15555555555',
            'message' => 'Test Message'
        ];
        $this->helper->mockPhoneService();
        $this->actingAs($user)
            ->json('POST', route('send-message',$phone->id), $input)
            ->assertStatus(403);
    }

    /**
     * @test
     * @group phone
     */
    public function managers_can_send_sms_messages_for_phones_they_dont_own()
    {
        $manager = $this->helper->user('manager');
        $other = $this->helper->userWithPhone();
        $phone = $other->phones->first();
        $input = [
            'to_number' => '+15555555555',
            'message' => 'Test Message'
        ];
        $this->helper->mockPhoneService();
        $this->actingAs($manager)
            ->json('POST', route('send-message',$phone->id), $input)
            ->assertStatus(200);
    }
}
