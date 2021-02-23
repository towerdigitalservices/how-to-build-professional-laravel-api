<?php

namespace App\Http\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        //
    ];

    protected $availableIncludes = [
        'role',
        'phones'
    ];

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }

    public function includeRole(User $user)
    {
        return $this->item($user->role, new RoleTransformer);
    }

    public function includePhones(User $user)
    {
        return $this->collection($user->phones, new PhoneTransformer);
    }
}
