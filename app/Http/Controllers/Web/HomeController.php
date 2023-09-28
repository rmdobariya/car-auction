<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CarInquiryStoreRequest;
use App\Mail\Web\CarInquiryMail;
use App\Models\CarInquiry;
use App\Models\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $featured_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_featured')
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
            ->get();
        $popular_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_popular')
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
            ->get();
        $hot_deal_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_hot_deal')
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
            ->get();
        $sell_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_featured')
            ->where('vehicles.is_vehicle_type', 'car_for_sell')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
            ->get();
        $testimonials = DB::table('testimonials')
            ->leftJoin('testimonial_translations', 'testimonials.id', 'testimonial_translations.testimonial_id')
            ->where('testimonial_translations.locale', App::getLocale())
            ->where('testimonials.status', 'active')
            ->whereNull('testimonials.deleted_at')
            ->orderBy('testimonials.id', 'desc')
            ->select('testimonials.*', 'testimonial_translations.title', 'testimonial_translations.role', 'testimonial_translations.description')
            ->get();
        $news = DB::table('blogs')
            ->leftJoin('blog_translations', 'blogs.id', 'blog_translations.blog_id')
            ->where('blog_translations.locale', App::getLocale())
            ->where('blogs.status', 'active')
            ->whereNull('blogs.deleted_at')
            ->orderBy('blogs.id', 'desc')
            ->select('blogs.*', 'blog_translations.title', 'blog_translations.description')
            ->get();

        return view('website.home.index', [
            'featured_vehicles' => $featured_vehicles,
            'popular_vehicles' => $popular_vehicles,
            'hot_deal_vehicles' => $hot_deal_vehicles,
            'news' => $news,
            'testimonials' => $testimonials,
            'sell_vehicles' => $sell_vehicles,
        ]);
    }

    public function vehicleDetail($id)
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_translations.short_description', 'vehicle_translations.description', 'vehicle_categories.name as category_name')
            ->first();
        $bid_count = DB::table('vehicle_bids')->where('vehicle_id', $id)->count();
        $vehicle_images = DB::table('vehicle_images')->where('vehicle_id', $id)->get();

        $view = view('website.home.vehicle-detail-body', [
            'vehicle' => $vehicle,
            'vehicle_images' => $vehicle_images,
            'bid_count' => $bid_count,
        ])->render();

        return response()->json([
            'data' => $view,
            'modal_title' => $vehicle->vehicle_name,
        ]);
    }

    public function vehicleInquiry($vehicle_id)
    {
        $user = Auth::user();
        if (!is_null($user)) {
            $view = view('website.home.vehicle_inquiry_body', [
                'user' => $user,
                'vehicle_id' => $vehicle_id,
            ])->render();

            return response()->json([
                'success' => true,
                'data' => $view,
                'modal_title' => 'Vehicle Inquiry',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please First Login Or Sign up',
            ]);
        }
    }

    public function vehicleBid($id)
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
            ->first();
        $last_bid_amount = $vehicle->price;
        $bid_amount = $vehicle->price + $vehicle->bid_increment;
        $bid = DB::table('vehicle_bids')->where('vehicle_id', $id)->orderBy('id', 'desc')->first();
        if (!is_null($bid)) {
            $last_bid_amount = $bid->amount;
            $bid_amount = $bid->amount + $vehicle->bid_increment;
        }
        $view = view('website.home.vehicle-bid-body', [
            'vehicle' => $vehicle,
            'last_bid_amount' => $last_bid_amount,
            'bid_amount' => $bid_amount,
        ])->render();

        return response()->json([
            'data' => $view,
            'modal_title' => $vehicle->vehicle_name . ' ' . 'Bid Place Modal',
        ]);
    }

    public function carInquirySubmit(CarInquiryStoreRequest $request)
    {
        $inquiry_count = DB::table('car_inquiries')->where('user_id', $request->user_id)->where('vehicle_id', $request->vehicle_id)->count();
        if ($inquiry_count > 0) {
            return response()->json([
                'success' => false,
                'message' => "Car Inquiry Is Already Added",
            ]);
        }
        $car_inquiry = new CarInquiry();
        $car_inquiry->user_id = $request->user_id;
        $car_inquiry->first_name = $request->first_name;
        $car_inquiry->last_name = $request->last_name;
        $car_inquiry->email = $request->email;
        $car_inquiry->message = $request->message;
        $car_inquiry->vehicle_id = $request->vehicle_id;
        $car_inquiry->save();


        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->where('vehicles.id', $request->vehicle_id)
            ->where('vehicle_translations.locale', App::getLocale())
            ->select('vehicle_translations.name as vehicle_name')
            ->first();
        $user = DB::table('users')->where('id', $request->user_id)->first();

        $notification = new Notification();
        $notification->user_id = $request->user_id;
        $notification->vehicle_id = $request->vehicle_id;
        $notification->type = 'car_inquiry';
        $notification->message = 'You have received new Inquiry for your car' . ' ' . $vehicle->vehicle_name . ' From ' . $user->name . ' ' . $user->last_name . ',' . $user->email;
        $notification->save();
        $array = [
            'full_name' => $user->name . ' ' . $user->last_name,
            'first_name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'request_msg' => $user->message,
            'mail_title' => 'Car Inquiry',
            'message' => 'You have received new Inquiry for your car' . ' ' . $vehicle->vehicle_name . ' ' . 'as follows.',
            'subject' => 'Car Inquiry',
        ];
        Mail::to($request->input('email'))->send(new CarInquiryMail($array));
        return response()->json([
            'success' => true,
            'message' => "Add Car Inquiry Successfully",
        ]);
    }
}
