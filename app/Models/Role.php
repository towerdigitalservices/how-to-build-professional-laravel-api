<?php

namespace App\Models;

use App\Models\Traits\UsesUuids;
use App\Models\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use UsesUuids,
        HasPermissions,
        HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
