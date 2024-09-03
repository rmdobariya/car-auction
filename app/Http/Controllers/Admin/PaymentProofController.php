<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Models\PaymentProof;
use App\Models\VehicleBid;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TaqnyatSms;
use Yajra\DataTables\Facades\DataTables;

class PaymentProofController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:payment-proof-read|bid-detail', ['only' => ['index']]);
        $this->middleware('permission:payment-proof-status', ['only' => ['changeStatus']]);
    }

    public function index()
    {
        return view('admin.payment-proof.index');
    }


    public function getPaymentProofList(Request $request)
    {
        if ($request->ajax()) {
            $payment_proof = DB::table('payment_proofs')
                ->leftJoin('users', 'payment_proofs.user_id', 'users.id')
                ->select('payment_proofs.*',
                    'users.full_name as user_name', 'users.user_type as user_type');
            return Datatables::of($payment_proof)
                ->addColumn('action', function ($payment_proof) {
                    $array = [
                        'id' => $payment_proof->id,
                        'actions' => [
                            'payment-status' => $payment_proof->status,
                            'status_permission' => Auth::user()->can('payment-proof-status'),
                        ]
                    ];

                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($payment_proof) {
                    $array['status'] = $payment_proof->status;
                    return AdminDataTableButtonHelper::paymentStatusBadge($array);
                })
                ->addColumn('payment_proof', function ($payment_proof) {
                    $payment_proof = '<a href="' . asset($payment_proof->payment_proof) . '" target="_blank"><img src="' . asset($payment_proof->payment_proof) . '" style="width:100px"></a>';
                    return $payment_proof;
                })
                ->rawColumns(['status', 'action', 'payment_proof'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        $payment_proof = DB::table('payment_proofs')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $payment_proof->user_id)->first();
        PaymentProof::where('id', $id)->update(['status' => $status]);
        $bearer = 'Bearer e2f5bb78ed5b80135604bb70a8056a4f';
        $taqnyt = new TaqnyatSms($bearer);
        if ($status != 'reject') {
            $body = trans('admin_string.approval_sms_message');
            if (!is_null($user)) {
                if (!is_null($user->contact_no)) {
                    $recipients = ['966' . $user->contact_no];
                } else {
                    $recipients = ['966563205156'];
                }
            } else {
                $recipients = ['966563205156'];
            }
//        $recipients = ['966563205156'];
            $sender = 'Zodha';

            $taqnyt = $taqnyt->sendMsg($body, $recipients, $sender);
            \Log::info('Taqnyat Response:', (array)$taqnyt);

            \Log::info('SMS Text Payment Proof:', ['body' => $body]);
        } else {
            $body = trans('admin_string.your_payment_proof_has_been') . ' ' . trans('admin_string.' . $status) . ' ' . trans('admin_string.by_admin');
            if (!is_null($user)) {
                if (!is_null($user->contact_no)) {
                    $recipients = ['966' . $user->contact_no];
                } else {
                    $recipients = ['966563205156'];
                }
            } else {
                $recipients = ['966563205156'];
            }
//        $recipients = ['966563205156'];
            $sender = 'Zodha';

            $taqnyt = $taqnyt->sendMsg($body, $recipients, $sender);
            \Log::info('Taqnyat Response:', (array)$taqnyt);

            \Log::info('SMS Text Payment Proof:', ['body' => $body]);
        }

        return response()->json([
            'message' => trans('admin_string.status_change_successfully'),
        ]);
    }
}
