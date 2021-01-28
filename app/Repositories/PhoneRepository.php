<?php
namespace App\Repositories;

use App\Models\Phone;
use App\Models\User;
use App\Contracts\PhoneService;
use TowerDigital\Tools\Repositories\BaseRepository;

class PhoneRepository extends BaseRepository
{
    public function __construct(Phone $phone)
    {
        parent::__construct($phone);

        $this->service = app()->make(PhoneService::class);
    }

    public function searchForNumber(string $areaCode, int $count)
    {
        return $this->service->searchAvailableNumbers($areaCode, $count);
    }

    public function provisionPhone(string $phoneNumber, string $userId)
    {
        $user = User::find($userId);
        $number = $this->service->provisionNumber($phoneNumber);
        return $user->phones()->create($number);
    }

    public function removePhone(string $id)
    {
        $phone = $this->byId($id);
        $this->service->removeNumber($phone->twilio_phone_id);
        $this->delete($id);
    }

    public function sendMessage(string $phoneId, string $toNumber, string $message)
    {
        $phone = $this->byId($phoneId);
        return $this->service->sendMessage($phone->twilio_phone_number, $toNumber, $message);
    }
}