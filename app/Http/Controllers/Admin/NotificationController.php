<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\VehicleTranslation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:notification-read', ['only' => ['index']]);
        $this->middleware('permission:notification-delete', ['only' => ['destroy', 'multipleNotificationDelete', 'hardDelete']]);
        $this->middleware('permission:notification-detail', ['only' => ['show']]);
    }

    public function index()
    {
        $notifications = DB::table('notifications')->where('is_read', 0)->get();
        foreach ($notifications as $notification) {
            DB::table('notifications')->where('id', $notification->id)->update([
                'is_read' => 1
            ]);
        }
        return view('admin.notification.index');
    }

    public function destroy($id): JsonResponse
    {
        DB::table('notifications')->where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function getNotificationList(Request $request)
    {
        if ($request->ajax()) {
            $notification = DB::table('notifications')
                ->leftJoin('users', 'notifications.user_id', 'users.id')
                ->select('notifications.*', 'users.name as user_name');
            return Datatables::of($notification)
                ->addColumn('action', function ($notification) {
                    $array = [
                        'id' => $notification->id,
                        'actions' => [
                            'delete' => $notification->id,
                            'delete_permission' => Auth::user()->can('notification-delete'),
                            'detail-page' => route('admin.notification-detail', [$notification->id]),
                            'detail_permission' => Auth::user()->can('notification-detail'),
                        ]
                    ];
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('check', function ($notification) {

                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value=' . $notification->id . '>
                    </div>
                </td>';
                })
                ->addColumn('user_name', function ($notification) {
                    return $notification->user_name;
                })
                ->addColumn('notification_type', function ($notification) {
                    return str_replace('_',' ',ucfirst($notification->type));
                })
                ->addColumn('created_at', function ($notification) {
                    $createdAt = Carbon::parse($notification->created_at);
                    return $createdAt->diffForHumans();
                })
                ->rawColumns(['action', 'status', 'check'])
                ->make(true);
        }
    }

    public function multipleNotificationDelete(Request $request): JsonResponse
    {
        $notifications = DB::table('notifications')->whereIn('id', $request->ids)->get();
        foreach ($notifications as $notification) {
            DB::table('notifications')->where('id', $notification->id)->delete();
        }
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function show($id)
    {
        $notification = DB::table('notifications')->where('id', $id)->first();
        return view('admin.notification.detail',[
            'notification' => $notification
        ]);
    }
}
