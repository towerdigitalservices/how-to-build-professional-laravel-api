<?php

namespace Tests;
use App\Models\User;
use App\Models\Role;

class TestHelper
{
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
}
