<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $notification = DB::table('notifications')
            ->leftJoin('vehicles', 'notifications.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('notifications.user_id', $user->id)
            ->whereNull('notifications.deleted_at')
            ->select('notifications.*', 'vehicle_translations.name as vehicle_name', 'vehicles.main_image as vehicle_image')
            ->orderBy('notifications.id','desc')
            ->get();
//        $notification = Notification::where('user_id', $user->id)->orderBy('id','desc')->get();
        $result = NotificationResource::collection($notification);
        if (count($notification) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['Notification' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['Notification' => $result],
            ]);
        }
    }

    public function destroy($id)
    {
        Notification::where('id', $id)->delete();
        return response()->json([
            'message' => trans('app_string.notification_delete_successfully')
        ]);
    }
}
