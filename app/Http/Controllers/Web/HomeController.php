<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CarInquiryStoreRequest;
use App\Http\Requests\Web\ContactUsStoreRequest;
use App\Http\Requests\Web\QuestionStoreRequest;
use App\Mail\Web\CarInquiryMail;
use App\Models\CarInquiry;
use App\Models\ContactUs;
use App\Models\Notification;
use App\Models\Question;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $featured_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicles.is_product', 'is_featured')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->limit(3)
            ->get();
        $popular_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_popular')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->limit(3)
            ->get();
        $hot_deal_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_hot_deal')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->limit(3)
            ->get();
        $sell_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_featured')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_vehicle_type', 'car_for_sell')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->limit(3)
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

        $featured_vehicle_count = DB::table('vehicles')
            ->where('is_product', 'is_featured')
            ->where('vehicles.status', 'approve')
            ->count();
        $popular_vehicle_count = DB::table('vehicles')
            ->where('is_product', 'is_popular')
            ->where('vehicles.status', 'approve')
            ->count();
        $hot_deal_count = DB::table('vehicles')
            ->where('is_product', 'is_hot_deal')
            ->where('vehicles.status', 'approve')
            ->count();
        $car_for_sell_count = DB::table('vehicles')
            ->where('is_vehicle_type', 'car_for_sell')
            ->where('vehicles.status', 'approve')
            ->count();

        $corporate_sellers = DB::table('users')
            ->where('is_corporate_seller', 1)
            ->where('user_type', 'seller')
            ->whereNull('deleted_at')
            ->get();
        $modal_hot_deal_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_hot_deal')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->get();
        return view('website.home.index', [
            'featured_vehicles' => $featured_vehicles,
            'popular_vehicles' => $popular_vehicles,
            'hot_deal_vehicles' => $hot_deal_vehicles,
            'news' => $news,
            'testimonials' => $testimonials,
            'sell_vehicles' => $sell_vehicles,
            'featured_vehicle_count' => $featured_vehicle_count,
            'popular_vehicle_count' => $popular_vehicle_count,
            'hot_deal_count' => $hot_deal_count,
            'car_for_sell_count' => $car_for_sell_count,
            'corporate_sellers' => $corporate_sellers,
            'modal_hot_deal_vehicles' => $modal_hot_deal_vehicles,
        ]);
    }

    public function seller(Request $request, $id)
    {
        $id = decrypt($id);
        $user = DB::table('users')->where('id', $id)->first();
        if ($user->is_corporate_seller == 1) {
            $featured_vehicles = DB::table('vehicles')
                ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
                ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
                ->whereNull('vehicles.deleted_at')
                ->where('vehicles.is_product', 'is_featured')
                ->where('vehicles.status', 'approve')
                ->where('vehicles.user_id', $id)
                ->where('category_translations.locale', App::getLocale())
                ->where('vehicles.is_vehicle_type', 'car_for_auction');
//        if (!is_null($request->condition)){
//
//        }
            if (!is_null($request->category)) {
                $featured_vehicles->where('vehicles.vehicle_category_id', $request->category);
            }
            if (!is_null($request->city)) {
                $featured_vehicles->where('vehicles.city_id', $request->city);
            }
            if (!is_null($request->price_range)) {
                $featured_vehicles->where('vehicles.price', '>=', $request->min_amount)
                    ->where('vehicles.price', '<=', $request->max_amount);
            }
            if (!is_null($request->model)) {
                $featured_vehicles->where('vehicle_translations.model', 'LIKE', '%' . $request->model . '%');
            }
            if (!is_null($request->make)) {
                $featured_vehicles->where('vehicle_translations.make', 'LIKE', '%' . $request->make . '%');
            }
            if (!is_null($request->body_type)) {
                $featured_vehicles->where('vehicle_translations.body_type', 'LIKE', '%' . $request->body_type . '%');
            }
            if (!is_null($request->exterior)) {
                $featured_vehicles->whereIn('vehicle_translations.color', explode(',', $request->exterior));
            }
            if (!is_null($request->ratting)) {
                $rat = explode('-', str_replace(' ', '', $request->ratting));
                $featured_vehicles->where('vehicles.ratting', '>=', $rat[0])
                    ->where('vehicles.ratting', '<=', $rat[1]);
            }
            $featured_vehicles = $featured_vehicles->where('vehicle_translations.locale', App::getLocale())
                ->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
                ->get();
            $popular_vehicles = DB::table('vehicles')
                ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
                ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
                ->whereNull('vehicles.deleted_at')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('category_translations.locale', App::getLocale())
                ->where('vehicles.is_product', 'is_popular')
                ->where('vehicles.is_vehicle_type', 'car_for_auction')
                ->where('vehicles.status', 'approve')
                ->where('vehicles.user_id', $id);
            //        if (!is_null($request->condition)){
//
//        }
            if (!is_null($request->category)) {
                $popular_vehicles->where('vehicles.vehicle_category_id', $request->category);
            }
            if (!is_null($request->city)) {
                $popular_vehicles->where('vehicles.city_id', $request->city);
            }
            if (!is_null($request->price_range)) {
                $popular_vehicles->where('vehicles.price', '>=', $request->min_amount)
                    ->where('vehicles.price', '<=', $request->max_amount);;
            }
            if (!is_null($request->model)) {
                $popular_vehicles->where('vehicle_translations.model', 'LIKE', '%' . $request->model . '%');
            }
            if (!is_null($request->make)) {
                $popular_vehicles->where('vehicle_translations.make', 'LIKE', '%' . $request->make . '%');
            }
            if (!is_null($request->body_type)) {
                $popular_vehicles->where('vehicle_translations.body_type', 'LIKE', '%' . $request->body_type . '%');
            }
            if (!is_null($request->exterior)) {
                $popular_vehicles->whereIn('vehicle_translations.color', explode(',', $request->exterior));
            }
            if (!is_null($request->ratting)) {
                $rat = explode('-', str_replace(' ', '', $request->ratting));
                $popular_vehicles->where('vehicles.ratting', '>=', $rat[0])
                    ->where('vehicles.ratting', '<=', $rat[1]);
            }
            $popular_vehicles = $popular_vehicles->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
                ->get();
            $hot_deal_vehicles = DB::table('vehicles')
                ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
                ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
                ->whereNull('vehicles.deleted_at')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('category_translations.locale', App::getLocale())
                ->where('vehicles.is_product', 'is_hot_deal')
                ->where('vehicles.status', 'approve')
                ->where('vehicles.user_id', $id)
                ->where('vehicles.is_vehicle_type', 'car_for_auction');
            //        if (!is_null($request->condition)){
//
//        }
            if (!is_null($request->category)) {
                $hot_deal_vehicles->where('vehicles.vehicle_category_id', $request->category);
            }
            if (!is_null($request->city)) {
                $hot_deal_vehicles->where('vehicles.city_id', $request->city);
            }
            if (!is_null($request->price_range)) {
                $hot_deal_vehicles->where('vehicles.price', '>=', $request->min_amount)
                    ->where('vehicles.price', '<=', $request->max_amount);
            }
            if (!is_null($request->model)) {
                $hot_deal_vehicles->where('vehicle_translations.model', 'LIKE', '%' . $request->model . '%');
            }
            if (!is_null($request->make)) {
                $hot_deal_vehicles->where('vehicle_translations.make', 'LIKE', '%' . $request->make . '%');
            }
            if (!is_null($request->body_type)) {
                $hot_deal_vehicles->where('vehicle_translations.body_type', 'LIKE', '%' . $request->body_type . '%');
            }
            if (!is_null($request->exterior)) {
                $hot_deal_vehicles->whereIn('vehicle_translations.color', explode(',', $request->exterior));
            }
            if (!is_null($request->ratting)) {
                $rat = explode('-', str_replace(' ', '', $request->ratting));
                $hot_deal_vehicles->where('vehicles.ratting', '>=', $rat[0])
                    ->where('vehicles.ratting', '<=', $rat[1]);
            }
            $hot_deal_vehicles = $hot_deal_vehicles->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
                ->get();
            $sell_vehicles = DB::table('vehicles')
                ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
                ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
                ->whereNull('vehicles.deleted_at')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('vehicles.is_product', 'is_featured')
                ->where('category_translations.locale', App::getLocale())
                ->where('vehicles.status', 'approve')
                ->where('vehicles.user_id', $id)
                ->where('vehicles.is_vehicle_type', 'car_for_sell');
            if (!is_null($request->category)) {
                $sell_vehicles->where('vehicles.vehicle_category_id', $request->category);
            }
            if (!is_null($request->city)) {
                $sell_vehicles->where('vehicles.city_id', $request->city);
            }
            if (!is_null($request->price_range)) {
                $sell_vehicles->where('vehicles.price', '>=', $request->min_amount)
                    ->where('vehicles.price', '<=', $request->max_amount);;
            }
            if (!is_null($request->model)) {
                $sell_vehicles->where('vehicle_translations.model', 'LIKE', '%' . $request->model . '%');
            }
            if (!is_null($request->make)) {
                $sell_vehicles->where('vehicle_translations.make', 'LIKE', '%' . $request->make . '%');
            }
            if (!is_null($request->body_type)) {
                $sell_vehicles->where('vehicle_translations.body_type', 'LIKE', '%' . $request->body_type . '%');
            }
            if (!is_null($request->exterior)) {
                $sell_vehicles->whereIn('vehicle_translations.color', explode(',', $request->exterior));
            }
            if (!is_null($request->ratting)) {
                $rat = explode('-', str_replace(' ', '', $request->ratting));
                $sell_vehicles->where('vehicles.ratting', '>=', $rat[0])
                    ->where('vehicles.ratting', '<=', $rat[1]);
            }
            $sell_vehicles = $sell_vehicles->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
                ->get();

            return view('website.seller.index', [
                'featured_vehicles' => $featured_vehicles,
                'popular_vehicles' => $popular_vehicles,
                'hot_deal_vehicles' => $hot_deal_vehicles,
                'sell_vehicles' => $sell_vehicles,
                'user' => $user,
            ]);
        }
        abort(404);
    }

    public function typeWiseCar($flag)
    {
        if ($flag == 'is_popular') {
            $title = 'Popular Vehicle';
        } elseif ($flag == 'is_hot_deal') {
            $title = 'Hot Deals';
        } else {
            $title = 'Featured Vehicle';
        }
        $vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.is_product', $flag)
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->where('vehicles.status', 'approve')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
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

        return view('website.home.type_wise_vehicle', [
            'vehicles' => $vehicles,
            'news' => $news,
            'testimonials' => $testimonials,
            'title' => $title,
        ]);
    }

    public function carForSell($flag)
    {
        $vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.is_vehicle_type', $flag)
            ->where('vehicles.status', 'approve')
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
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

        return view('website.home.car_for_sell', [
            'vehicles' => $vehicles,
            'news' => $news,
            'testimonials' => $testimonials,
        ]);
    }

    public function vehicleDetail($id)
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
            ->select('vehicles.*', 'vehicle_translations.name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
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
            'modal_title' => $vehicle->name,
        ]);
    }
    public function homeVehicleDetail($id)
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
            ->select('vehicles.*', 'vehicle_translations.name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->first();
        $bid_count = DB::table('vehicle_bids')->where('vehicle_id', $id)->count();
        $vehicle_images = DB::table('vehicle_images')->where('vehicle_id', $id)->get();
        $vehicle_documents = DB::table('vehicle_documents')->where('vehicle_id', $id)->get();

        return view('website.home.vehicle-detail-page', [
            'vehicle' => $vehicle,
            'vehicle_images' => $vehicle_images,
            'vehicle_documents' => $vehicle_documents,
            'bid_count' => $bid_count,
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
                'modal_title' => trans('web_string.vehicle_inquiry'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('web_string.please_first_login_or_sign_up')
            ]);
        }
    }

    public function vehicleBid($id)
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
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
            'modal_title' => $vehicle->vehicle_name . ' ' . trans('web_string.bid_place_modal'),
        ]);
    }

    public function carInquirySubmit(CarInquiryStoreRequest $request)
    {
        $inquiry_count = DB::table('car_inquiries')->where('user_id', $request->user_id)->where('vehicle_id', $request->vehicle_id)->count();
        if ($inquiry_count > 0) {
            return response()->json([
                'success' => false,
                'message' => trans('web_string.car_inquiry_is_already_added'),
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
            'mail_title' => 'Car Inquiry',
            'message' => 'You have received new Inquiry for your car' . ' ' . $vehicle->vehicle_name . ' ' . 'as follows.',
            'subject' => 'Car Inquiry',
        ];
        Mail::to($user->email)->send(new CarInquiryMail($array));
        return response()->json([
            'success' => true,
            'message' => trans('web_string.add_car_inquiry_successfully'),
        ]);
    }

    public function wishList(Request $request)
    {
        $count = DB::table('wish_lists')->where('vehicle_id', $request->vehicle_id)->where('user_id', $request->user_id)->count();
        if ($count > 0) {
            DB::table('wish_lists')->where('vehicle_id', $request->vehicle_id)->where('user_id', $request->user_id)->delete();
            return response()->json([
                'success' => true,
                'is_wishlist' => 0,
                'message' => trans('web_string.remove_in_wishlist_successfully'),
            ]);
        } else {
            $wish_list = new WishList();
            $wish_list->user_id = $request->user_id;
            $wish_list->vehicle_id = $request->vehicle_id;
            $wish_list->save();
            return response()->json([
                'success' => true,
                'is_wishlist' => 1,
                'message' => trans('web_string.add_in_wishlist_successfully'),
            ]);
        }
    }

    public function contactUsSubmit(ContactUsStoreRequest $request)
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
        return response()->json([
            'success' => true,
            'message' => trans('web_string.contact_us_save_successfully')
        ]);
    }

    public function addQuestionStore(QuestionStoreRequest $request)
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
            'message' => trans('web_string.question_save_successfully')
        ]);
    }

    public function filter(Request $request)
    {
        $featured_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicles.is_product', 'is_featured')
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_vehicle_type', 'car_for_auction');
//        if (!is_null($request->condition)){
//
//        }
        if (!is_null($request->category)) {
            $featured_vehicles->where('vehicles.vehicle_category_id', $request->category);
        }
        if (!is_null($request->city)) {
            $featured_vehicles->where('vehicles.city_id', $request->city);
        }
        if (!is_null($request->price_range)) {
            $featured_vehicles->where('vehicles.price', '>=', $request->min_amount)
                ->where('vehicles.price', '<=', $request->max_amount);
        }
        if (!is_null($request->model)) {
            $featured_vehicles->where('vehicle_translations.model', 'LIKE', '%' . $request->model . '%');
        }
        if (!is_null($request->make)) {
            $featured_vehicles->where('vehicle_translations.make', 'LIKE', '%' . $request->make . '%');
        }
        if (!is_null($request->body_type)) {
            $featured_vehicles->where('vehicle_translations.body_type', 'LIKE', '%' . $request->body_type . '%');
        }
        if (!is_null($request->exterior)) {
            $featured_vehicles->whereIn('vehicle_translations.color', explode(',', $request->exterior));
        }
        if (!is_null($request->ratting)) {
            $rat = explode('-', str_replace(' ', '', $request->ratting));
            $featured_vehicles->where('vehicles.ratting', '>=', $rat[0])
                ->where('vehicles.ratting', '<=', $rat[1]);
        }
        $featured_vehicles = $featured_vehicles->where('vehicle_translations.locale', App::getLocale())
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->get();
        $popular_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_popular')
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->where('vehicles.status', 'approve');
        //        if (!is_null($request->condition)){
//
//        }
        if (!is_null($request->category)) {
            $popular_vehicles->where('vehicles.vehicle_category_id', $request->category);
        }
        if (!is_null($request->city)) {
            $popular_vehicles->where('vehicles.city_id', $request->city);
        }
        if (!is_null($request->price_range)) {
            $popular_vehicles->where('vehicles.price', '>=', $request->min_amount)
                ->where('vehicles.price', '<=', $request->max_amount);;
        }
        if (!is_null($request->model)) {
            $popular_vehicles->where('vehicle_translations.model', 'LIKE', '%' . $request->model . '%');
        }
        if (!is_null($request->make)) {
            $popular_vehicles->where('vehicle_translations.make', 'LIKE', '%' . $request->make . '%');
        }
        if (!is_null($request->body_type)) {
            $popular_vehicles->where('vehicle_translations.body_type', 'LIKE', '%' . $request->body_type . '%');
        }
        if (!is_null($request->exterior)) {
            $popular_vehicles->whereIn('vehicle_translations.color', explode(',', $request->exterior));
        }
        if (!is_null($request->ratting)) {
            $rat = explode('-', str_replace(' ', '', $request->ratting));
            $popular_vehicles->where('vehicles.ratting', '>=', $rat[0])
                ->where('vehicles.ratting', '<=', $rat[1]);
        }
        $popular_vehicles = $popular_vehicles->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->get();
        $hot_deal_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_hot_deal')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_vehicle_type', 'car_for_auction');
        //        if (!is_null($request->condition)){
//
//        }
        if (!is_null($request->category)) {
            $hot_deal_vehicles->where('vehicles.vehicle_category_id', $request->category);
        }
        if (!is_null($request->city)) {
            $hot_deal_vehicles->where('vehicles.city_id', $request->city);
        }
        if (!is_null($request->price_range)) {
            $hot_deal_vehicles->where('vehicles.price', '>=', $request->min_amount)
                ->where('vehicles.price', '<=', $request->max_amount);
        }
        if (!is_null($request->model)) {
            $hot_deal_vehicles->where('vehicle_translations.model', 'LIKE', '%' . $request->model . '%');
        }
        if (!is_null($request->make)) {
            $hot_deal_vehicles->where('vehicle_translations.make', 'LIKE', '%' . $request->make . '%');
        }
        if (!is_null($request->body_type)) {
            $hot_deal_vehicles->where('vehicle_translations.body_type', 'LIKE', '%' . $request->body_type . '%');
        }
        if (!is_null($request->exterior)) {
            $hot_deal_vehicles->whereIn('vehicle_translations.color', explode(',', $request->exterior));
        }
        if (!is_null($request->ratting)) {
            $rat = explode('-', str_replace(' ', '', $request->ratting));
            $hot_deal_vehicles->where('vehicles.ratting', '>=', $rat[0])
                ->where('vehicles.ratting', '<=', $rat[1]);
        }
        $hot_deal_vehicles = $hot_deal_vehicles->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->get();
        $sell_vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.is_product', 'is_featured')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_vehicle_type', 'car_for_sell');
        if (!is_null($request->category)) {
            $sell_vehicles->where('vehicles.vehicle_category_id', $request->category);
        }
        if (!is_null($request->city)) {
            $sell_vehicles->where('vehicles.city_id', $request->city);
        }
        if (!is_null($request->price_range)) {
            $sell_vehicles->where('vehicles.price', '>=', $request->min_amount)
                ->where('vehicles.price', '<=', $request->max_amount);;
        }
        if (!is_null($request->model)) {
            $sell_vehicles->where('vehicle_translations.model', 'LIKE', '%' . $request->model . '%');
        }
        if (!is_null($request->make)) {
            $sell_vehicles->where('vehicle_translations.make', 'LIKE', '%' . $request->make . '%');
        }
        if (!is_null($request->body_type)) {
            $sell_vehicles->where('vehicle_translations.body_type', 'LIKE', '%' . $request->body_type . '%');
        }
        if (!is_null($request->exterior)) {
            $sell_vehicles->whereIn('vehicle_translations.color', explode(',', $request->exterior));
        }
        if (!is_null($request->ratting)) {
            $rat = explode('-', str_replace(' ', '', $request->ratting));
            $sell_vehicles->where('vehicles.ratting', '>=', $rat[0])
                ->where('vehicles.ratting', '<=', $rat[1]);
        }
        $sell_vehicles = $sell_vehicles->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
            ->get();

        $featured_vehicle_count = $featured_vehicles->count();
        $popular_vehicle_count = $popular_vehicles->count();
        $hot_deal_count = $hot_deal_vehicles->count();
        $car_for_sell_count = $sell_vehicles->count();
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

        $corporate_sellers = DB::table('users')
            ->where('is_corporate_seller', 1)
            ->where('user_type', 'seller')
            ->whereNull('deleted_at')
            ->get();

        return view('website.home.index', [
            'featured_vehicles' => $featured_vehicles,
            'popular_vehicles' => $popular_vehicles,
            'hot_deal_vehicles' => $hot_deal_vehicles,
            'news' => $news,
            'testimonials' => $testimonials,
            'sell_vehicles' => $sell_vehicles,
            'featured_vehicle_count' => $featured_vehicle_count,
            'popular_vehicle_count' => $popular_vehicle_count,
            'hot_deal_count' => $hot_deal_count,
            'car_for_sell_count' => $car_for_sell_count,
            'corporate_sellers' => $corporate_sellers,
        ]);
    }

    public function myBids()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if ($user) {
            $bids = DB::table('vehicle_bids')
                ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
                ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
                ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
                ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('category_translations.locale', App::getLocale())
                ->where('vehicle_bids.user_id', $user_id)
                ->where('vehicles.auction_end_date', '>', date('Y-m-d'))
//                ->where('vehicle_bids.is_winner', 1)
                ->select('vehicle_bids.*', 'vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'users.full_name as user_name', 'category_translations.name as category_name')
                ->get();

            return view('website.user.my_bid', [
                'bids' => $bids
            ]);
        }
        abort(404);
    }

    public function myWinnings()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if ($user) {
            $winner_bids = DB::table('vehicle_bids')
                ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
                ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
                ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
                ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('category_translations.locale', App::getLocale())
                ->where('vehicle_bids.user_id', $user_id)
                ->where('vehicles.auction_end_date', '<', date('Y-m-d'))
                ->where('vehicle_bids.is_winner', 1)
                ->select('vehicle_bids.*', 'vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'users.full_name as user_name', 'category_translations.name as category_name')
                ->get();

            return view('website.user.winner_bid', [
                'winner_bids' => $winner_bids
            ]);
        }
        abort(404);
    }
}
