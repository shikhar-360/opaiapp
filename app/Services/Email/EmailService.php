<?php
// app/Services/Email/EmailService.php
namespace App\Services\Email;

use Mail;
use App\Mail\RegistrationMail;
use App\Mail\ForgotPasswordMail;
use App\Mail\OtpMail;

class EmailService
{
    public function sendRegistrationEmail($user)
    {
        Mail::to($user->email)->send(new RegistrationMail($user));
    }

    public function sendForgotPasswordEmail($email, $token)
    {
        Mail::to($email)->send(new ForgotPasswordMail($token));
    }

    public function sendOtpEmail($email, $otp, $user)
    {
        Mail::to($email)->send(new OtpMail($otp, $user));
    }
}
