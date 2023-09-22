<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\Web\ResetPasswordRequest;

class HomeController extends Controller
{
    public function index()
    {
        $vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
            ->get();
        $testimonials = DB::table('testimonials')
            ->leftJoin('testimonial_translations', 'testimonials.id', 'testimonial_translations.testimonial_id')
            ->where('testimonial_translations.locale', App::getLocale())
            ->where('testimonials.status', 'active')
            ->whereNull('testimonials.deleted_at')
            ->orderBy('testimonials.id', 'desc')
            ->select('testimonials.*', 'testimonial_translations.title', 'testimonial_translations.description')
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
            'vehicles' => $vehicles,
            'news' => $news,
            'testimonials' => $testimonials,
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

        $vehicle_images = DB::table('vehicle_images')->where('vehicle_id', $id)->get();

        $view = view('website.home.vehicle-detail-body', [
            'vehicle' => $vehicle,
            'vehicle_images' => $vehicle_images,
        ])->render();

        return response()->json([
            'data' => $view,
            'modal_title' => $vehicle->vehicle_name,
        ]);
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
        $last_bid_amount = $vehicle->minimum_bid_increment_price;
        $bid = DB::table('vehicle_bids')->where('vehicle_id', $id)->orderBy('id', 'desc')->first();
        if (!is_null($bid)) {
            $last_bid_amount = $bid->amount;
        }
        $view = view('website.home.vehicle-bid-body', [
            'vehicle' => $vehicle,
            'last_bid_amount' => $last_bid_amount,
        ])->render();

        return response()->json([
            'data' => $view,
            'modal_title' => $vehicle->vehicle_name . ' ' . 'Bid Place Modal',
        ]);
    }
}
