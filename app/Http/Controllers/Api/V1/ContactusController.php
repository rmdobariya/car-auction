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
        $user = $request->user();
        $contact_us = ContactUs::where('user_id',$user->id)->get();
        $result = ContactUsResource::collection($contact_us);
        return response()->json([
            'status' => true,
            'data' => ['contact_us' => $result],
        ]);
    }

    public function store(ContactUsStoreRequest $request)
    {
        $user = $request->user();
        $contact_us = new ContactUs();
        $contact_us->name = $request->name;
        $contact_us->user_id = $user->id;
        $contact_us->contact_number = $request->contact_number;
        $contact_us->address = $request->address;
        $contact_us->subject = $request->subject;
        $contact_us->message = $request->message;
        $contact_us->save();
        $array = [
            'name' => $user->name,
            'full_name' => $request->name,
            'contact_number' => $contact_us->contact_number,
            'address' => $contact_us->address,
            'mail_title' => 'Contact Us',
            'subject' => $contact_us->subject,
            'message' => $contact_us->message,
        ];
        Mail::to($user->email)->send(new ContactUsMail($array));
        return response()->json([
            'status' => true,
            'message' => 'Mail Sent Successfully',
        ]);
    }
}
