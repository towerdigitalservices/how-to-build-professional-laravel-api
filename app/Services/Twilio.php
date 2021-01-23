<?php
namespace App\Services;

use Twilio\Rest\Client;
use App\Services\Contracts\PhoneService;

class Twilio implements PhoneService
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client(config('phone.twilio.sid'),config('phone.twilio.token'));
    }

    public function searchAvailableNumbers(string $areaCode, int $count)
    {
        $numbers = $this->client
            ->availablePhoneNumbers('US')
            ->local
            ->read(['areaCode' => $areaCode, 'smsEnabled' => true ], $count);
        return collect($numbers)
            ->map(function($number) {
                return [
                    'friendly_name' => $number->friendlyName,
                    'number' => $number->phoneNumber,
                ];
            })->all();
    }

    public function provisionNumber(string $phoneNumber)
    {
        $incoming = $this->client
            ->incomingPhoneNumbers
            ->create(['phoneNumber' => $phoneNumber]);
        return [
            'twilio_phone_number' => $incoming->phoneNumber,
            'twilio_phone_id' => $incoming->sid,
        ];
    }

    public function removeNumber(string $phoneId)
    {
        return $this->client
            ->incomingPhoneNumbers($phoneId)
            ->delete();

    }

    public function sendMessage(string $from, string $to, string $body)
    {
        $message = $this->client
            ->messages
            ->create($to,['from' => $from, 'body' => $body]);

        return [
            'id' => $message->sid,
            'message'=> $message->body,
        ];
    }
}