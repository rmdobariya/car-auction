<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\VehicleBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{

    public function addBid(Request $request)
    {
        if (!is_null(Auth::user())) {
            $vehicle = DB::table('vehicles')->where('id', $request->vehicle_id)->first();
            $amount = $vehicle->price + $vehicle->bid_increment;
            $user_id = Auth::user()->id;
            $bid = DB::table('vehicle_bids')->where('user_id', $user_id)->where('vehicle_id', $request->vehicle_id)->first();
            if (!is_null($bid)) {
                $amount = $bid->amount + $vehicle->bid_increment;
                if ($amount < $request->amount) {
                    DB::table('vehicle_bids')
                        ->where('user_id', $user_id)
                        ->where('vehicle_id', $request->vehicle_id)
                        ->update([
                            'amount' => $request->amount
                        ]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Bid Update Successfully'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Enter an amount greater than the last amount'
                    ]);
                }
            } else {
                if ($amount < $request->amount) {
                    $bid = new VehicleBid();
                    $bid->user_id = $user_id;
                    $bid->vehicle_id = $request->vehicle_id;
                    $bid->amount = $request->amount;
                    $bid->is_winner = 1;
                    $bid->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'Bid Add Successfully'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Enter an amount greater than the last amount'
                    ]);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please First Login Or Sign Up'
            ]);
        }
    }

    public function updatedBid($vehicle_id)
    {
        $bids = DB::table('vehicle_bids')
            ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicle_bids.vehicle_id', $vehicle_id)
            ->select('vehicle_bids.*', 'vehicle_translations.name as vehicle_name', 'vehicles.auction_start_date', 'vehicles.auction_end_date', 'vehicles.minimum_bid_increment_price', 'users.full_name as user_name', 'vehicles.bid_increment')
            ->get();
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.id', $vehicle_id)
            ->select('vehicles.*')
            ->first();
        DB::table('vehicle_bids')
            ->where('vehicle_id', $vehicle_id)->update([
                'is_winner' => 0,
            ]);
        $maxValue = DB::table('vehicle_bids')->where('vehicle_id', $vehicle_id)->max('amount');
        DB::table('vehicle_bids')
            ->where('vehicle_id', $vehicle_id)
            ->where('amount', $maxValue)
            ->update([
                'is_winner' => 1,
            ]);
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
