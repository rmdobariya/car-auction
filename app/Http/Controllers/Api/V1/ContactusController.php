<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ContactUsStoreRequest;
use App\Http\Resources\ContactUsResource;
use App\Http\Resources\FaqResource;
use App\Mail\ContactUsMail;
use App\Mail\ForgotPasswordMail;
use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactusController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $contact_us = ContactUs::whereNull('deleted_at')->get();
        $result = ContactUsResource::collection($contact_us);
        return response()->json([
            'status' => true,
            'data' => ['contact_us' => $result],
        ]);
    }

    public function store(ContactUsStoreRequest $request)
    {
        $contact_us = new ContactUs();
        $contact_us->first_name = $request->first_name;
        $contact_us->last_name = $request->last_name;
        $contact_us->name = $request->first_name . ' ' . $request->last_name;
        $contact_us->email = $request->email;
        $contact_us->contact_number = $request->mobile_no;
        $contact_us->message = $request->message;
        $contact_us->subject = 'contact_us';
        $contact_us->save();
        $array = [
            'name' => $request->first_name,
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'contact_number' => $request->mobile_no,
            'mail_title' => 'Contact Us',
            'subject' => 'Contact Us',
            'message' => $request->message,
        ];
        Mail::to($request->email)->send(new ContactUsMail($array));
        return response()->json([
            'status' => true,
            'message' => 'Mail Sent Successfully',
        ]);
    }
}
