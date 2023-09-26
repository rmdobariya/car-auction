<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\VehicleBid;
use Illuminate\Http\Request;
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
}
