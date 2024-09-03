<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Models\PaymentProof;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:review-read', ['only' => ['index']]);
        $this->middleware('permission:review-status', ['only' => ['changeStatus']]);
    }

    public function index()
    {
        return view('admin.review.index');
    }


    public function getReviewList(Request $request)
    {
        if ($request->ajax()) {
            $reviews = DB::table('reviews')
                ->leftJoin('users', 'reviews.user_id', 'users.id')
                ->select('reviews.*', 'users.full_name as user_name', 'users.user_type as user_type');
            return Datatables::of($reviews)
                ->addColumn('action', function ($reviews) {
                    $array = [
                        'id' => $reviews->id,
                        'actions' => [
                            'status' => $reviews->status,
                            'status_permission' => Auth::user()->can('payment-proof-status'),
                        ]
                    ];

                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })

                ->addColumn('status', function ($reviews) {
                    $array['status'] = $reviews->status;
                    return AdminDataTableButtonHelper::StatusBadge($array);
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Review::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => trans('admin_string.status_change_successfully'),
        ]);
    }
}
