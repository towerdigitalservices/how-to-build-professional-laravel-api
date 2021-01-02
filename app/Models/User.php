<?php

namespace App\Models;

use App\Models\Traits\UsesJWT;
use App\Models\Traits\UsesUuids;
use App\Models\Traits\HasRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,
        UsesJWT,
        UsesUuids,
        HasRole,
        HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

}
