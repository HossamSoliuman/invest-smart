<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Http\Requests\StoreContactUsRequest;
use App\Http\Requests\UpdateContactUsRequest;
use App\Http\Resources\ContactUsResource;
use Illuminate\Support\Facades\Http;

class ContactUsController extends Controller
{

    public function index()
    {
        $contactUs = ContactUs::all();
        $contactUs = ContactUsResource::collection($contactUs);
        return view('contactus', compact('contactUs'));
    }

    public function store(StoreContactUsRequest $request)
    {
        $validated = $request->validated();

        $recaptchaToken = $validated['recaptcha'];
        $response = $this->validateRecaptcha($recaptchaToken);
        $isValidRecaptcha = $response->json()['success'] ?? false;
        if (!$isValidRecaptcha) {
            return $this->apiResponse(null, 'Invalid reCAPTCHA token', 0);
        }
        unset($validated['recaptcha']);

        $contactUs = ContactUs::create($validated);
        return $this->apiResponse($contactUs, 'Created');
    }

    public function destroy(ContactUs $contactUs)
    {
        $contactUs->delete();
        return redirect()->route('contact-uses.index');
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
}
