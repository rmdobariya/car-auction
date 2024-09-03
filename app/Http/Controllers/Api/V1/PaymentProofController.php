<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PaymentProofStoreRequest;
use App\Models\PaymentProof;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentProofController extends Controller
{

    public function paymentProofStore(PaymentProofStoreRequest $request)
    {
        $user = $request->user();
        if (!is_null($user)) {
            $record = DB::table('payment_proofs')->where('user_id',Auth::user()->id)->first();
            if (!is_null($record)){
                $payment_proof = PaymentProof::find($record->id);
                $proof = ImageUploadHelper::imageUpload($request->file('payment_proof'), 'vehicle-bid-payment-proof');
                $payment_proof->user_id = $user->id;
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
                $payment_proof->user_id = $user->id;
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
}
