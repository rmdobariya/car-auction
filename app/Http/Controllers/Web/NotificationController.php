<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        DB::table('notifications')->where('user_id', Auth::user()->id)->update([
            'is_read' => 1,
        ]);
        $notifications = DB::table('notifications')
            ->leftJoin('vehicles', 'notifications.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('notifications.user_id', Auth::user()->id)
            ->whereNull('notifications.deleted_at')
            ->select('notifications.*', 'vehicle_translations.name as vehicle_name', 'vehicles.main_image as vehicle_image')
            ->get();
        return view('website.user.notification', [
            'notifications' => $notifications,
        ]);
    }

    public function destroy($id)
    {
        Notification::where('id',$id)->delete();
        return response()->json([
            'message' => trans('web_string.notification_delete_successfully')
        ]);
    }
}
