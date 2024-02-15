<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\QuestionStoreRequest;
use App\Http\Requests\API\CarInquiryStoreRequest;
use App\Mail\Web\CarInquiryMail;
use App\Models\CarInquiry;
use App\Models\Notification;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QuestionController extends Controller
{
    public function index(QuestionStoreRequest $request): JsonResponse
    {
        $question = new Question();
        $question->first_name = $request->first_name;
        $question->last_name = $request->last_name;
        $question->name = $request->first_name . ' ' . $request->last_name;
        $question->email = $request->email;
        $question->contact_number = $request->mobile_no;
        $question->question = $request->question;
        $question->save();
        return response()->json([
            'status' => true,
            'message' => trans('app_string.question_save_successfully')
        ]);
    }
    public function carInquiry(CarInquiryStoreRequest $request)
    {
        $inquiry_count = DB::table('car_inquiries')->where('user_id', $request->user_id)->where('vehicle_id', $request->vehicle_id)->count();
        if ($inquiry_count > 0) {
            return response()->json([
                'success' => false,
                'message' => trans('app_string.car_inquiry_is_already_added'),
            ]);
        }
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->where('vehicles.id', $request->vehicle_id)
            ->where('vehicle_translations.locale', App::getLocale())
            ->select('vehicles.user_id as user_id', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage')
            ->first();
        $car_inquiry = new CarInquiry();
        $car_inquiry->user_id = $vehicle->user_id;
        $car_inquiry->first_name = $request->first_name;
        $car_inquiry->last_name = $request->last_name;
        $car_inquiry->email = $request->email;
        $car_inquiry->mobile_no = $request->mobile_no;
        $car_inquiry->message = $request->message;
        $car_inquiry->vehicle_id = $request->vehicle_id;
        $car_inquiry->save();

        $user = DB::table('users')->where('id', $vehicle->user_id)->first();

        $notification = new Notification();
        $notification->user_id = $user->id;
        $notification->vehicle_id = $request->vehicle_id;
        $notification->type = 'car_inquiry';
        $notification->first_name = $request->first_name;
        $notification->last_name = $request->last_name;
        $notification->email = $request->email;
        $notification->mobile_no = $request->mobile_no;
        $notification->question = $request->message;
        $notification->message = 'You have received new Inquiry for your car' . ' ' . $vehicle->vehicle_name . '<br><br>' . 'Name : ' . $request->first_name . ' ' . $request->last_name . '<br>' . 'Email : ' . $request->email . '<br>' . 'Mobile : ' . $request->mobile_no . '<br>' . 'Message : ' . $request->message;
        $notification->save();
        $array = [
            'full_name' => $user->name . ' ' . $user->last_name,
            'first_name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'mobile_no' => $request->mobile_no,
            'request_msg' => $request->message,
            'mail_title' => trans('app_string.car_inquiry'),
            'message' => 'You have received new Inquiry for your car' . ' ' . $vehicle->vehicle_name . ' ' . 'as follows.',
            'subject' => trans('app_string.car_inquiry'),
        ];
        Mail::to($user->email)->send(new CarInquiryMail($array));
        return response()->json([
            'success' => true,
            'message' => trans('app_string.add_car_inquiry_successfully'),
        ]);
    }
}
