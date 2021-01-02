<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class RoleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @group roles
     */
    public function admins_can_view_roles()
    {
        $admin = $this->helper->user('admin');

        $this->actingAs($admin)
            ->json('GET', route('get-roles'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @group roles
     */
    public function normal_users_cannot_access_role_data()
    {
        $user = $this->helper->user();

        $this->actingAs($user)
            ->json('GET', route('get-roles'))
            ->assertStatus(403);
    }

    /**
     * @test
     * @group roles
     */
    public function admins_can_create_and_view_roles()
    {
        $admin = $this->helper->user('admin');
        $input = [
            'name' => 'Test Role',
            'slug' => 'test-role',
        ];
        $response = $this->actingAs($admin)
            ->json('POST', route('create-role'), $input);
        $decoded = $response->decodeResponseJson();
        $this->actingAs($admin)
            ->json('GET', route('view-role',$decoded['data']['id']))
            ->assertJsonStructure(['data' => ['id','name','slug']]);
    }

    /**
     * @test
     * @group roles
     */
    public function admins_can_update_roles()
    {
        $admin = $this->helper->user('admin');
        $role = $this->helper->role();
        $input = [
            'name' => 'Test Role Updated',
            'slug' => 'test-role',
        ];
        $response = $this->actingAs($admin)
            ->json('PUT', route('update-role',$role->id), $input);
        $decoded = $response->decodeResponseJson();
        $this->assertEquals($decoded['data']['name'], $input['name']);
    }

    /**
     * @test
     * @group roles
     */
    public function admins_can_delete_roles()
    {
        $admin = $this->helper->user('admin');
        $role = $this->helper->role();
        $response = $this->actingAs($admin)
            ->json('DELETE', route('delete-role',$role->id))
            ->assertStatus(200);
    }
}
