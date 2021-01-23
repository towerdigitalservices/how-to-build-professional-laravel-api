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
        'roles',
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

    public function includeRoles(User $user)
    {
        return $this->collection($user->roles, new RoleTransformer);
    }
    public function includePhones(Phone $phone)
    {
        return $this->collection($user->phones, new PhoneTransformer);
    }
}
