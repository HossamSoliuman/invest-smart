<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateAuthRequest;
use App\Http\Resources\UserResource;
use App\Mail\Verification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\IpUtils;

class AuthenticationController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $validData = $request->validated();


        $recaptchaToken = $request->validated('recaptcha');
        $response = $this->validateRecaptcha($recaptchaToken);
        $isValidRecaptcha = $response->json()['success'] ?? false;
        if (!$isValidRecaptcha) {
            return $this->apiResponse(null, 'Invalid reCAPTCHA token', 0);
        }
        unset($validData['recaptcha']);

        $accountId = Str::random(20);
        $validData['password'] = Hash::make($validData['password']);

        $latestUser = User::latest('account_id')->first();
        $accountId = $latestUser ? str_pad((int)$latestUser->account_id + 1, 5, '0', STR_PAD_LEFT) : '00001';
        $validData['account_id'] = $accountId;

        $user = User::create($validData);
        $token = $user->createToken('auth_token')->plainTextToken;
        $user = User::find($user->id);
        return $this->apiResponse(
            [
                'token' => $token,
                'user' => UserResource::make($user),
            ],
        );
    }


    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $recaptchaToken = $request->validated('recaptcha');
        $response = $this->validateRecaptcha($recaptchaToken);
        $isValidRecaptcha = $response->json()['success'] ?? false;
        if (!$isValidRecaptcha) {
            return $this->apiResponse(null, 'Invalid reCAPTCHA token', 0);
        }
        unset($validated['recaptcha']);

        if (!Auth::attempt($validated)) {
            return $this->apiResponse(null, 'Email or password is wrong', 0, 401);
        }

        $user = User::where('email', $validated['email'])->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->apiResponse(
            [
                'token' => $token,
                'user' => UserResource::make($user),
            ],
        );
    }


    function validateRecaptcha($recaptchaToken)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";

        $body = [
            'secret' => env('RECAPTCHA_SECRET'),
            'response' => $recaptchaToken
        ];

        $response = Http::asForm()->post($url, $body);

        return  $response;
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
            return $this->apiResponse([], 'Successfully logged out');
        } else {
            return $this->apiErrorResponse('Unauthorized', 401);
        }
    }

    public function update(UpdateAuthRequest $request)
    {
        $user = $request->user();
        $validated = $request->validated();

        if ($validated['password'] == null) {
            unset($validated['password']);
        }

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
return $validated;
        $user->fill($validated)->save();

        if ($request->expectsJson()) {
            return $this->apiResponse(
                [
                    'user' => UserResource::make($user),
                ],
                'User updated successfully'
            );
        }

        return redirect()->route('user.update')->with('success', 'User updated successfully');
    }

    function user(Request $request)
    {
        return UserResource::make($request->user());
    }
    public function verify($token)
    {
        $user = auth('sanctum')->user();
        $exsitToken = $user->email_verification_token;
        if ($exsitToken == $token) {
            return $this->apiResponse(UserResource::make($user), 'verified');
        }
        return $this->apiResponse(UserResource::make($user), 'token wronk', 0);
    }

    public function sendVerificationMail()
    {
        $user = auth('sanctum')->user();
        $user = User::find($user->id);
        $token = Str::random(50);
        $user->update([
            'email_verification_token' => $token
        ]);
        // return $user;
        Mail::to($user->email)->send(new Verification($user));
    }
}
