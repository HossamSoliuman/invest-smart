<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Mail\Verification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;

class VerificationController extends Controller
{
    public function send(Request $request)
    {
        $user = User::find($request->user()->id);

        // if ($user->email_verification_count >= 3) {
        //     return $this->apiResponse(null, 'You have sent 3 times, please connect with support', 0);
        // }

        // if ($user->last_mail_at && $user->last_mail_at > Carbon::now()->subMinute()) {
        //     return $this->apiResponse(null, 'Please wait a minute after the last mail sent', 0);
        // }

        $code = random_int(100000, 999999);
        $user->email_verification_code = $code;
        $user->increment('email_verification_count');
        $user->last_mail_at = Carbon::now();
        $user->save();

        Mail::to($user->email)->send(new Verification($user));

        return $this->apiResponse(null, 'Sent successfully');
    }


    public function check(Request $request)
    {
        $user = $request->user();

        if (!$user->email_verification_code || $request->code != $user->email_verification_code) {
            return $this->apiResponse(null, 'The code you entered is wrong', 0);
        }

        $user->email_verified_at = now();
        $user->email_verification_code = null; 
        $user->save();

        return $this->apiResponse(null, 'Verified');
    }
}
