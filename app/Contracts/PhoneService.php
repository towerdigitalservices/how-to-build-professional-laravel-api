<?php

namespace App\Contracts;

interface PhoneService
{
    public function searchAvailableNumbers(string $areaCode, int $count);
    public function provisionNumber(string $phoneNumber);
    public function removeNumber(string $phoneId);
    public function sendMessage(string $from, string $to, string $body);
}