<?php

namespace App\Observers;

use App\Models\User;
use App\Events\UserSignedUp;

class UserObserver
{
    public function created(User $user)
    {
        UserSignedUp::dispatch($user);
    }
}
