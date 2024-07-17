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
                ->leftJoin('vehicles', 'payment_proofs.vehicle_id', 'vehicles.id')
                ->leftJoin('vehicle_translations', 'payment_proofs.vehicle_id', 'vehicle_translations.vehicle_id')
                ->leftJoin('users', 'payment_proofs.user_id', 'users.id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->select('payment_proofs.*', 'vehicle_translations.name  as vehicle_name', 'vehicles.status as vehicle_status',
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
                    $payment_proof = '<a href="'.asset($payment_proof->payment_proof).'" target="_blank"><img src="'.asset($payment_proof->payment_proof).'" style="width:100px"></a>';
                    return $payment_proof;
                })
                ->rawColumns(['status', 'action','payment_proof'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        PaymentProof::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => trans('admin_string.status_change_successfully'),
        ]);
    }
}
