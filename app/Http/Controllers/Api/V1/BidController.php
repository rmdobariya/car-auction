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

class BidController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $bids = DB::table('vehicle_bids')
            ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicle_bids.user_id', $user->id)
            ->select('vehicle_bids.id as bid_id', 'vehicle_bids.user_id as bid_user_id', 'vehicle_bids.amount as bid_amount', 'vehicle_bids.vehicle_id as bid_vehicle_id', 'vehicle_translations.name  as vehicle_name', 'category_translations.name as vehicle_category_name',
                'vehicle_translations.description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'users.full_name as user_name', 'vehicles.*')
            ->get();
        $result = BidResource::collection($bids);
        if (count($bids) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['bid' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['bid' => $result]
            ]);
        }
    }

    public function vehicleWiseBid($id): JsonResponse
    {
        $bids = DB::table('vehicle_bids')
            ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicle_bids.vehicle_id', $id)
            ->where('category_translations.locale', App::getLocale())
            ->select('vehicle_bids.id as bid_id', 'vehicle_bids.user_id as bid_user_id', 'vehicle_bids.amount as bid_amount', 'vehicle_bids.vehicle_id as bid_vehicle_id', 'vehicle_translations.name  as vehicle_name', 'category_translations.name as vehicle_category_name',
                'vehicle_translations.description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'users.full_name as user_name', 'vehicles.*')
            ->get();
        $result = BidResource::collection($bids);
        if (count($bids) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['bid' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not Found',
                'data' => ['bid' => $result]
            ]);
        }
    }

    public function show($id, Request $request): JsonResponse
    {
        $user = $request->user();
        $bids = DB::table('vehicle_bids')
            ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicle_bids.user_id', $user->id)
            ->where('vehicle_bids.id', $id)
            ->select('vehicle_bids.id as bid_id', 'vehicle_bids.amount', 'vehicle_bids.user_id as bid_user_id', 'vehicle_bids.vehicle_id as bid_vehicle_id', 'vehicle_translations.name  as vehicle_name', 'category_translations.name as vehicle_category_name',
                'vehicle_translations.description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'users.full_name as user_name', 'vehicles.*')
            ->get();
        $result = BidDetailResource::collection($bids);
        if (count($bids) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['bid' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not Found',
                'data' => ['bid' => $result]
            ]);
        }

    }

    public function myBid(Request $request): JsonResponse
    {
        $user = $request->user();
        $bids = DB::table('vehicle_bids')
            ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicle_bids.user_id', $user->id)
            ->where('vehicles.auction_end_date', '>=', date('Y-m-d'))
            ->select('vehicle_bids.id as bid_id', 'vehicle_bids.amount as bid_amount', 'vehicle_bids.user_id as bid_user_id', 'vehicle_bids.vehicle_id as bid_vehicle_id', 'vehicle_translations.name  as vehicle_name', 'category_translations.name as vehicle_category_name',
                'vehicle_translations.description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'users.full_name as user_name', 'vehicles.*')
            ->get();
        $result = BidResource::collection($bids);
        if (count($bids) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['My-Bid' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not Found',
                'data' => ['My-Bid' => $result]
            ]);
        }
    }

    public function myWining(Request $request): JsonResponse
    {
        $user = $request->user();
        $bids = DB::table('vehicle_bids')
            ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicle_bids.user_id', $user->id)
            ->where('vehicles.auction_end_date', '<', date('Y-m-d'))
            ->where('vehicle_bids.is_winner', 1)
            ->select('vehicle_bids.id as bid_id', 'vehicle_bids.amount as bid_amount', 'vehicle_bids.user_id as bid_user_id', 'vehicle_bids.vehicle_id as bid_vehicle_id', 'vehicle_translations.name  as vehicle_name', 'category_translations.name as vehicle_category_name',
                'vehicle_translations.description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'users.full_name as user_name', 'vehicles.*')
            ->get();
        $result = BidResource::collection($bids);
        if (count($bids) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['My-Winning' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['My-Winning' => $result]
            ]);
        }
    }

    public function placeBid(BidStoreRequest $request)
    {
        $vehicle = DB::table('vehicles')->where('id', $request->vehicle_id)->first();
        $amount = $vehicle->price + $vehicle->bid_increment;
        $user_id = $request->user()->id;
        $bid = DB::table('vehicle_bids')->where('vehicle_id', $request->vehicle_id)->max('amount');
        $bid_count = DB::table('vehicle_bids')->where('vehicle_id', $request->vehicle_id)->where('user_id', $user_id)->count();
        if ($bid_count > 0) {
            $amount = $bid + $vehicle->bid_increment;
            if ($amount < $request->amount) {
                DB::table('vehicle_bids')
                    ->where('user_id', $user_id)
                    ->where('vehicle_id', $request->vehicle_id)
                    ->update([
                        'amount' => $request->amount
                    ]);
                $maxValue = DB::table('vehicle_bids')->where('vehicle_id', $request->vehicle_id)->max('amount');
                DB::table('vehicle_bids')
                    ->where('vehicle_id', $request->vehicle_id)
                    ->update(['is_winner' => 0]);
                DB::table('vehicle_bids')
                    ->where('vehicle_id', $request->vehicle_id)
                    ->where('amount', $maxValue)
                    ->update([
                        'is_winner' => 1,
                    ]);
                return response()->json([
                    'success' => true,
                    'message' => trans('app_string.bid_update_successfully')
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app_string.enter_an_amount_greater_than') . $amount
                ]);
            }
        } else {
            if ($amount < $request->amount) {
                DB::table('vehicle_bids')
                    ->where('vehicle_id', $request->vehicle_id)
                    ->update(['is_winner' => 0]);
                $bid = new VehicleBid();
                $bid->user_id = $user_id;
                $bid->vehicle_id = $request->vehicle_id;
                $bid->amount = $request->amount;
                $bid->is_winner = 1;
                $bid->save();
                return response()->json([
                    'success' => true,
                    'message' => trans('app_string.bid_add_successfully')
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app_string.enter_an_amount_greater_than') . $amount
                ]);
            }
        }
    }
}
