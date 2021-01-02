<?php

namespace App\Http\Transformers;

use App\Models\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        //
    ];

    protected $availableIncludes = [
        //
    ];

    public function transform(Permission $permission)
    {
        return [
            'id' => $permission->id,
            'name' => $permission->name,
            'slug' => $permission->slug,
        ];
    }
}
