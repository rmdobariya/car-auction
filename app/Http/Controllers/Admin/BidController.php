<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Models\VehicleBid;
use App\Models\VehicleDocument;
use App\Models\VehicleImage;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BidController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:bid-read|bid-detail', ['only' => ['index']]);
        $this->middleware('permission:bid-detail', ['only' => ['show']]);
    }

    public function index()
    {
        return view('admin.bid.index');
    }


    public function getBidList(Request $request)
    {
        if ($request->ajax()) {
            $bids = DB::table('vehicle_bids')
                ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
                ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
                ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->select('vehicle_bids.*', 'vehicle_translations.name  as vehicle_name', 'vehicles.status',
                    'users.full_name as user_name', 'users.user_type as user_type');
            return Datatables::of($bids)
                ->addColumn('action', function ($bids) {
                    $array = [
                        'id' => $bids->id,
                        'actions' => [
                            'detail-page' => route('admin.bid.show', [$bids->id]),
                            'detail_permission' => Auth::user()->can('bid-detail'),
                        ]
                    ];

                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('bid_time', function ($bids) {
                    return Carbon::parse($bids->created_at)->format('d-m-Y h:i A');
                })
                ->addColumn('is_winner', function ($bids) {
                    if ($bids->is_winner == 1) {
                        $is_winner = '<div class="badge badge-light-success">' . trans('admin_string.yes') . '</div>';
                    } else {
                        $is_winner = '<div class="badge badge-light-danger">' . trans('admin_string.no') . '</div>';
                    }
                    return $is_winner;
                })
                ->addColumn('amount', function ($bids) {
                    return number_format($bids->amount, 2);
                })

                ->addColumn('status', function ($bids) {
                    $array['status'] = $bids->status;
                    return AdminDataTableButtonHelper::vehicleStatusBadge($array);
                })
                ->rawColumns(['is_winner', 'status', 'action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $vehicle_id = DB::table('vehicle_bids')->where('id', $id)->first()->vehicle_id;
        $vehicle = DB::table('vehicles')
            ->leftJoin('users', 'vehicles.user_id', 'users.id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->leftjoin('roles', 'model_has_roles.role_id', 'roles.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.id', $vehicle_id)
            ->select('vehicles.*', 'users.name as user_name', 'category_translations.name as category_name', 'roles.name as role_name', 'vehicle_translations.*')
            ->first();
        $vehicle_images = VehicleImage::where('vehicle_id', $vehicle_id)->get();
        $vehicle_documents = VehicleDocument::where('vehicle_id', $vehicle_id)->get();
        return view('admin.bid.show', [
            'vehicle' => $vehicle,
            'vehicle_images' => $vehicle_images,
            'vehicle_documents' => $vehicle_documents,
        ]);
    }

    public function changeStatus($id, $status): JsonResponse
    {
        VehicleBid::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => trans('admin_string.status_change_successfully'),
        ]);
    }
}
