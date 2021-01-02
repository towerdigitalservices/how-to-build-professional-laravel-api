<?php

namespace App\Models;

use App\Models\Traits\UsesUuids;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use UsesUuids;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}
