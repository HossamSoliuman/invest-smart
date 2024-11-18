<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Verification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user)
    {
        //
    }

    public function build()
    {
        $verificationCode =  $this->user->email_verification_code;
        return $this->subject('Verify Your Email Address')
            ->view('auth.sendMail')
            ->with([
                'userName' => $this->user->name,
                'verificationCode' => $verificationCode,
            ]);
    }
}
