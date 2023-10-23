<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BidStoreRequest;
use App\Http\Resources\BidDetailResource;
use App\Http\Resources\BidResource;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\VehicleBid;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyAuctionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $ongoing_auction = DB::table('vehicle_bids')
            ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.auction_end_date', '>=', date('Y-m-d'))
            ->select('vehicle_bids.id as bid_id', 'vehicle_bids.user_id as bid_user_id', 'vehicle_bids.vehicle_id as bid_vehicle_id', 'vehicle_translations.name as vehicle_name', 'vehicle_translations.short_description', 'vehicle_translations.description', 'users.full_name as user_name', 'vehicles.*')
            ->get();

        $wining_bids = DB::table('vehicle_bids')
            ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicle_bids.user_id', $user->id)
            ->where('vehicles.auction_end_date', '<', date('Y-m-d'))
            ->where('vehicle_bids.is_winner', 1)
            ->select('vehicle_bids.id as bid_id', 'vehicle_bids.user_id as bid_user_id', 'vehicle_bids.vehicle_id as bid_vehicle_id', 'vehicle_translations.name as vehicle_name', 'vehicle_translations.short_description', 'vehicle_translations.description', 'users.full_name as user_name', 'vehicles.*')
            ->get();

        $completed_auction = DB::table('vehicle_bids')
            ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicle_bids.user_id', $user->id)
            ->where('vehicles.auction_end_date', '<', date('Y-m-d'))
            ->where('vehicle_bids.is_winner', 0)
            ->select('vehicle_bids.id as bid_id', 'vehicle_bids.user_id as bid_user_id', 'vehicle_bids.vehicle_id as bid_vehicle_id', 'vehicle_translations.name as vehicle_name', 'vehicle_translations.short_description', 'vehicle_translations.description', 'users.full_name as user_name', 'vehicles.*')
            ->get();
        $ongoing_auction = BidResource::collection($ongoing_auction);
        $wining_bids = BidResource::collection($wining_bids);
        $completed_auction = BidResource::collection($completed_auction);
        return response()->json([
            'status' => true,
            'data' => ['Ongoing Auction' => $ongoing_auction, 'wining_bids' => $wining_bids, 'completed_auction' => $completed_auction],
        ]);
    }

    public function myWining(Request $request): JsonResponse
    {
        $user = $request->user();

        $result = BidResource::collection($bids);
        return response()->json([
            'status' => true,
            'data' => ['My-Bid' => $result],
        ]);
    }
}
