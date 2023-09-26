<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{

    public function index()
    {
        if (!is_null(Auth::user())) {
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->where('user_type', 'seller')->first();
            $vehicles = DB::table('vehicles')
                ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
                ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
                ->whereNull('vehicles.deleted_at')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('vehicles.user_id', $user->id)
                ->orderBy('vehicles.id', 'desc')
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
                ->get();

            return view('website.auction.add-auction', [
                'user' => $user,
                'vehicles' => $vehicles,
            ]);
        }

        abort(404);
    }

    public function vehicleBidListing($id)
    {
        $user_id = Auth::user()->id;
        $bids = DB::table('vehicle_bids')
            ->leftJoin('vehicles','vehicle_bids.vehicle_id','vehicles.id')
            ->leftJoin('vehicle_translations','vehicle_bids.vehicle_id','vehicle_translations.vehicle_id')
            ->leftJoin('users','vehicle_bids.user_id','users.id')
            ->where('vehicle_translations.locale', App::getLocale())
//            ->where('vehicle_bids.user_id', $user_id)
            ->where('vehicle_bids.vehicle_id', $id)
            ->select('vehicle_bids.*','vehicle_translations.name as vehicle_name','vehicles.auction_start_date','vehicles.auction_end_date','vehicles.minimum_bid_increment_price','users.full_name as user_name','vehicles.bid_increment')
            ->get();
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
            ->select('vehicles.*')
            ->first();
        $view = view('website.auction.bid_listing_model_body', [
            'bids' => $bids,
            'vehicle' => $vehicle,
        ])->render();

        return response()->json([
            'data' => $view,
//            'modal_title' => $vehicle->vehicle_name,
        ]);
    }

    public function updatedBid($vehicle_id)
    {
        $bids = DB::table('vehicle_bids')
            ->leftJoin('vehicles','vehicle_bids.vehicle_id','vehicles.id')
            ->leftJoin('vehicle_translations','vehicle_bids.vehicle_id','vehicle_translations.vehicle_id')
            ->leftJoin('users','vehicle_bids.user_id','users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicle_bids.vehicle_id', $vehicle_id)
            ->select('vehicle_bids.*','vehicle_translations.name as vehicle_name','vehicles.auction_start_date','vehicles.auction_end_date','vehicles.minimum_bid_increment_price','users.full_name as user_name','vehicles.bid_increment')
            ->get();
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.id', $vehicle_id)
            ->select('vehicles.*')
            ->first();
        $view = view('website.auction.update-bid', [
            'bids' => $bids,
            'vehicle' => $vehicle,
        ])->render();

        return response()->json([
            'data' => $view,
//            'modal_title' => $vehicle->vehicle_name,
        ]);
    }
}
