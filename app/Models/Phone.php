<?php

namespace App\Models;

use App\Models\Traits\UsesUuids;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use UsesUuids;

    protected $fillable = [
        'twilio_phone_id',
        'twilio_phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
