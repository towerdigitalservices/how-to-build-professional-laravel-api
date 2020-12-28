<?php

namespace Tests;
use App\Models\User;

class TestHelper
{
    public function user()
    {
        return User::factory()->create();
    }
}
