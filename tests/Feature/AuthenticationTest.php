<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    use WithFaker,
        DatabaseTransactions;

    /**
     * @test
     * @group authentication
     */
    public function users_can_register_and_login()
    {

        $input = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ];
        $this->json('POST', route('register'), $input)
            ->assertJsonStructure(['data' =>['id','name','email']]);
        $this->json('POST', route('login'), $input)
            ->assertJsonStructure(['data' => ['token', 'token_type', 'expires_in']]);
    }

    /**
     * @test
     * @group authentication
     */
    public function users_can_login_and_refresh_token()
    {
        $user = $this->helper->user();
        $input = [
            'email' => $user->email,
            'password' => 'password',
        ];
        $this->json('POST', route('login'), $input)
            ->assertJsonStructure(['data' => ['token', 'token_type', 'expires_in']]);
        $this->json('POST', route('refresh'))
            ->assertJsonStructure(['data' => ['token', 'token_type', 'expires_in']]);
    }

    /**
     * @test
     * @group authentication
     */
    public function users_can_update_password_and_login_again()
    {
        $user = $this->helper->user();
        $input = [
            'user_id' => $user->id,
            'password' => 'newpassword'
        ];
        auth()->login($user);
        $this->actingAs($user)
            ->json('POST', route('update-password'), $input)
            ->assertStatus(200);
        auth()->logout();
        $input = [
            'email' => $user->email,
            'password' => 'newpassword',
        ];
        $this->json('POST', route('login'), $input)
            ->assertJsonStructure(['data' => ['token', 'token_type', 'expires_in']]);

    }

    /**
     * @test
     * @group authentication
     */
    public function users_can_logout()
    {
        $user = $this->helper->user();
        auth()->login($user);
        $this->actingAs($user)
            ->json('POST', route('logout'))
            ->assertStatus(200);
    }

}
