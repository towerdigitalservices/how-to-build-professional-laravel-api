<?php

namespace App\Http\Transformers;

use App\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        //
    ];

    protected $availableIncludes = [
        'permissions',
    ];

    public function transform(Role $role)
    {
        return [
            'id' => $role->id,
            'name' => $role->name,
            'slug' => $role->slug,
        ];
    }

    public function includePermissions(Role $role)
    {
        return $this->collection($role->permissions, new PermissionTransformer);
    }
}
