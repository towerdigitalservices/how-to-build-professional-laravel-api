<?php

namespace App\Models\Traits;

use App\Models\Permission;

trait HasPermissions
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermissionTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('slug',$permission)->firstOrFail();
        }
        return $this->permissions->contains($permission);
    }

    public function givePermissionTo(...$permissions)
    {
        $permissions = collect($permissions)
            ->flatten()
            ->map(function ($permission) {
                if (is_string($permission)) {
                    return Permission::where('slug', $permission)->first();
                }
                if ($permission instanceof Permission) {
                    return $permission;
                }
                return false;
            })
            ->filter(function ($permission) {
                return $permission instanceof Permission;
            })
            ->map->id
            ->all();

        $this->permissions()->syncWithoutDetaching($permissions);
    }

    public function removePermissionTo(...$permissions)
    {
        $permissions = collect($permissions)
            ->flatten()
            ->map(function ($permission) {
                if (is_string($permission)) {
                    return Permission::where('slug', $permission)->first();
                }
                if ($permission instanceof Permission) {
                    return $permission;
                }
                return false;
            })
            ->filter(function ($permission) {
                return $permission instanceof Permission;
            })
            ->map->id
            ->all();

        $this->permissions()->detach($permissions);
    }
}