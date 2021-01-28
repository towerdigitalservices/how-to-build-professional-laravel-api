<?php

return [
    'service' => env('PHONE_SERVICE', ''),
    'twilio' => [
        'sid' => env('TWILIO_ACCOUNT_SID', ''),
        'token' => env('TWILIO_AUTH_TOKEN', ''),
    ],
    'some-other-service' => [
        // Some Other Service Credentials
    ]
];