<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function index($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page) {
            return view('website.page.index', ['page' => $page]);

        }
        abort(404);
    }

    public function contactUs()
    {
        return view('website.page.contact_us');
    }

    public function auction()
    {
        $user = Auth::user();
        if (!is_null($user)) {
            $vehicles = DB::table('vehicles')
                ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
                ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
                ->whereNull('vehicles.deleted_at')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('vehicles.user_id', $user->id)
                ->where('vehicles.is_vehicle_type', 'car_for_auction')
                ->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
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
                ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
                ->whereNull('vehicles.deleted_at')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('wish_lists.user_id', $user->id)
                ->where('vehicles.is_vehicle_type', 'car_for_auction')
                ->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
                ->get();

            return view('website.user.wish_list', [
                'vehicles' => $vehicles
            ]);
        } else {
            abort(404);
        }

    }
}
