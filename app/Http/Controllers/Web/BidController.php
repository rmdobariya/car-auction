<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PaymentProofStoreRequest;
use App\Models\PaymentProof;
use App\Models\VehicleBid;
use App\Models\VehicleBidPaymentDetail;
use Carbon\Carbon;
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
            $currentDateTime = Carbon::now();
            $auction = DB::table('vehicles')
                ->leftJoin('vehicle_translations', 'vehicles.id', '=', 'vehicle_translations.vehicle_id')
                ->where('vehicles.auction_start_date', '<=', $currentDateTime->toDateString())
                ->where('vehicles.auction_end_date', '>=', $currentDateTime->toDateString())
                ->where(function ($query) use ($currentDateTime) {
                    $query->whereRaw("TIMESTAMPDIFF(MINUTE, '{$currentDateTime->toDateTimeString()}', CONCAT(vehicles.auction_end_date, ' ', vehicles.auction_end_time)) >= 1");
                })
                ->where('vehicles.id', $request->vehicle_id)
                ->select('vehicles.*', 'vehicle_translations.name as vehicle_name')
                ->first();
            if (!is_null($auction)) {
                $end_time = Carbon::parse($auction->auction_end_time);
                $new_end_time = $end_time->addSeconds(30);
                DB::table('vehicles')->where('id', $auction->id)->update([
                    'auction_end_time' => $new_end_time->toTimeString()
                ]);
            }
            $amount = $vehicle->price + $vehicle->bid_increment;
            $user_id = Auth::user()->id;
            $bid = DB::table('vehicle_bids')->where('user_id', $user_id)->where('vehicle_id', $request->vehicle_id)->first();
            if (!is_null($bid)) {
                $amount = $bid->amount + $vehicle->bid_increment;
                if ($amount <= $request->amount) {
                    DB::table('vehicle_bids')
                        ->where('user_id', $user_id)
                        ->where('vehicle_id', $request->vehicle_id)
                        ->update([
                            'amount' => $request->amount
                        ]);
                    $maxValue = DB::table('vehicle_bids')->where('vehicle_id', $request->vehicle_id)->max('amount');
                    DB::table('vehicle_bids')
                        ->where('vehicle_id', $request->vehicle_id)
                        ->where('amount', $maxValue)
                        ->update([
                            'is_winner' => 1,
                        ]);
                    DB::table('vehicle_bids')
                        ->where('vehicle_id', $request->vehicle_id)
                        ->where('amount', '!=', $maxValue)
                        ->update([
                            'is_winner' => 0,
                        ]);
                    if (!is_null($request->payment_proof)) {
                        $payment_proof = ImageUploadHelper::imageUpload($request->file('payment_proof'), 'vehicle-bid-payment-proof');
                        $vehicle_bid_payment_detail = new VehicleBidPaymentDetail();
                        $vehicle_bid_payment_detail->vehicle_bid_id = $bid->id;
                        $vehicle_bid_payment_detail->amount = $request->amount;
                        $vehicle_bid_payment_detail->payment_proof = $payment_proof;
                        $vehicle_bid_payment_detail->save();
                    }

                    return response()->json([
                        'success' => true,
                        'message' => trans('web_string.bid_update_successfully')
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => trans('web_string.enter_an_amount_greater_than') . $amount
                    ]);
                }
            } else {
                if ($amount <= $request->amount) {

                    $bid = new VehicleBid();
                    $bid->user_id = $user_id;
                    $bid->vehicle_id = $request->vehicle_id;
                    $bid->amount = $request->amount;
                    $bid->is_winner = 0;
                    $bid->save();
                    $maxValue = DB::table('vehicle_bids')->where('vehicle_id', $request->vehicle_id)->max('amount');
                    DB::table('vehicle_bids')
                        ->where('vehicle_id', $request->vehicle_id)
                        ->where('amount', $maxValue)
                        ->update([
                            'is_winner' => 1,
                        ]);
                    DB::table('vehicle_bids')
                        ->where('vehicle_id', $request->vehicle_id)
                        ->where('amount', '!=', $maxValue)
                        ->update([
                            'is_winner' => 0,
                        ]);
                    if (!is_null($request->payment_proof)) {
                        $payment_proof = ImageUploadHelper::imageUpload($request->file('payment_proof'), 'vehicle-bid-payment-proof');
                        $vehicle_bid_payment_detail = new VehicleBidPaymentDetail();
                        $vehicle_bid_payment_detail->vehicle_bid_id = $bid->id;
                        $vehicle_bid_payment_detail->amount = $request->amount;
                        $vehicle_bid_payment_detail->payment_proof = $payment_proof;
                        $vehicle_bid_payment_detail->save();
                    }
                    return response()->json([
                        'success' => true,
                        'message' => trans('web_string.bid_add_successfully')
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => trans('web_string.enter_an_amount_greater_than') . $amount
                    ]);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('web_string.please_first_login_or_sign_up')
            ]);
        }
    }

    public function paymentProofStore(PaymentProofStoreRequest $request)
    {
        if (!is_null(Auth::user())) {
            $record = DB::table('payment_proofs')->where('user_id',Auth::user()->id)->where('vehicle_id',$request->vehicle_id)->first();
            if (!is_null($record)){
                $payment_proof = PaymentProof::find($record->id);
                $proof = ImageUploadHelper::imageUpload($request->file('payment_proof'), 'vehicle-bid-payment-proof');
                $payment_proof->user_id = Auth::user()->id;
                $payment_proof->vehicle_id = $request->vehicle_id;
                $payment_proof->payment_proof = $proof;
                $payment_proof->status = 'pending';
                $payment_proof->save();
                return response()->json([
                    'success' => true,
                    'message' => trans('web_string.payment_proof_update_successfully')
                ]);
            }else{
                $payment_proof = new PaymentProof();
                $proof = ImageUploadHelper::imageUpload($request->file('payment_proof'), 'vehicle-bid-payment-proof');
                $payment_proof->user_id = Auth::user()->id;
                $payment_proof->vehicle_id = $request->vehicle_id;
                $payment_proof->payment_proof = $proof;
                $payment_proof->save();
                return response()->json([
                    'success' => true,
                    'message' => trans('web_string.payment_proof_add_successfully')
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('web_string.please_first_login_or_sign_up')
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
            ->orderBy('vehicle_bids.amount', 'desc')
            ->select('vehicle_bids.*', 'vehicle_translations.name as vehicle_name', 'vehicles.auction_start_date', 'vehicles.auction_end_date', 'users.full_name as user_name', 'vehicles.bid_increment')
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
        ]);
    }
}
