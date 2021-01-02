<?php

namespace App\Models\Traits;

use App\Models\Role;

trait HasRole
{

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('slug',$role)->firstOrFail();
        }
        return $this->role == $role;
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('slug',$role)->firstOrFail();
        }
        $this->role()->associate($role);
    }

    public function removeRole()
    {
        $this->role()->dissociate();
    }
}