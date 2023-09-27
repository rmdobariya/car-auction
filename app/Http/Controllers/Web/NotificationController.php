<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    public function index()
    {
        $notifications = DB::table('notifications')
            ->leftJoin('vehicles', 'notifications.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('notifications.user_id', Auth::user()->id)
            ->select('notifications.*', 'vehicle_translations.name as vehicle_name','vehicles.main_image as vehicle_image')
            ->get();
        return view('website.user.notification', [
            'notifications' => $notifications,
        ]);


    }
}
