<?php

namespace App\Services;

use Twilio\Rest\Client;

class OtpService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(
            env('TWILIO_SID'),
            env('TWILIO_AUTH_TOKEN')
        );
    }

    public function sendOtp($phoneNumber, $otp)
    {
        $message = "Your OTP is: $otp";

        $this->twilio->messages->create(
            $phoneNumber,
            [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => $message
            ]
        );
    }

    public function generateOtp()
    {
        return rand(100000, 999999); // Generates a 6-digit OTP
    }
}
