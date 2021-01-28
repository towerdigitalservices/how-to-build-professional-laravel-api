<?php

namespace App\Http\Transformers;

use App\Models\Phone;
use League\Fractal\TransformerAbstract;

class PhoneTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        //
    ];

    protected $availableIncludes = [
        'user'
    ];

    public function transform(Phone $phone)
    {
        return [
            'id' => $phone->id,
            'twilio_phone_id' => $phone->twilio_phone_id,
            'twilio_phone_number' => $phone->twilio_phone_number,
        ];
    }

    public function includeUser(Phone $phone)
    {
        return $this->collection($phone->user, new UserTransformer);
    }
}
