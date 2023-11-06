<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index($slug)
    {
        $page = DB::table('pages')
            ->leftJoin('page_translations', 'pages.id', 'page_translations.page_id')
            ->where('page_translations.locale', App::getLocale())
            ->where('pages.slug', $slug)
            ->select('pages.*', 'page_translations.name', 'page_translations.description')
            ->first();
        if ($page) {
            return view('website.page.index', ['page' => $page]);
        }
        abort(404);
    }

    public function contactUs()
    {
        $mobile_no = DB::table('site_settings')->where('setting_key', 'CONTACT_NUMBER_1')->first()->setting_value;
        $whatsapp_mobile_no = DB::table('site_settings')->where('setting_key', 'WHATSAPP_NUMBER')->first()->setting_value;
        $address_1 = DB::table('site_settings')->where('setting_key', 'ADDRESS_1')->first()->setting_value;
        $address_2 = DB::table('site_settings')->where('setting_key', 'ADDRESS_2')->first()->setting_value;
        $email = DB::table('site_settings')->where('setting_key', 'FROM_EMAIL')->first()->setting_value;
        $address_google_map = DB::table('site_settings')->where('setting_key', 'ADDRESS_GOOGLE_MAP')->first()->setting_value;
        $facebook_link = DB::table('site_settings')->where('setting_key', 'FACEBOOK_LINK')->first()->setting_value;
        $instagram_ink = DB::table('site_settings')->where('setting_key', 'INSTAGRAM_LINK')->first()->setting_value;
        $twitter_link = DB::table('site_settings')->where('setting_key', 'TWITTER_LINK')->first()->setting_value;
        $pinterest_link = DB::table('site_settings')->where('setting_key', 'PINTEREST_LINK')->first()->setting_value;
        $dribble_link = DB::table('site_settings')->where('setting_key', 'DRIBBLE_LINK')->first()->setting_value;
        return view('website.page.contact_us', [
            'mobile_no' => $mobile_no,
            'whatsapp_mobile_no' => $whatsapp_mobile_no,
            'address_1' => $address_1,
            'address_2' => $address_2,
            'email' => $email,
            'address_google_map' => $address_google_map,
            'facebook_link' => $facebook_link,
            'instagram_ink' => $instagram_ink,
            'twitter_link' => $twitter_link,
            'pinterest_link' => $pinterest_link,
            'dribble_link' => $dribble_link,
        ]);
    }

    public function auction()
    {
        $user = Auth::user();
        if (!is_null($user)) {
            $vehicles = DB::table('vehicles')
                ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
                ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('category_translations.locale', App::getLocale())
                ->where('vehicles.user_id', $user->id)
                ->where('vehicles.status', 'approve')
                ->where('vehicles.is_vehicle_type', 'car_for_auction')
                ->whereNull('vehicles.deleted_at')
                ->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
                ->get();
            return view('website.auction.auction', [
                'vehicles' => $vehicles
            ]);
        } else {
            abort(404);
        }
    }

    public function wishListPage()
    {
        $user = Auth::user();
        if (!is_null($user)) {
            $vehicles = DB::table('wish_lists')
                ->leftJoin('vehicles', 'vehicles.id', 'wish_lists.vehicle_id')
                ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
                ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
                ->whereNull('vehicles.deleted_at')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('category_translations.locale', App::getLocale())
                ->where('wish_lists.user_id', $user->id)
                ->where('vehicles.is_vehicle_type', 'car_for_auction')
                ->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'category_translations.name as category_name')
                ->get();

            return view('website.user.wish_list', [
                'vehicles' => $vehicles
            ]);
        } else {
            abort(404);
        }
    }
}
