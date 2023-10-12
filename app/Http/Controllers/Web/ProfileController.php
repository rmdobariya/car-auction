<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if ($user) {
            $bids = DB::table('vehicle_bids')
                ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
                ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
                ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
                ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('vehicle_bids.user_id', $user_id)
                ->where('vehicle_bids.is_winner', 0)
                ->select('vehicle_bids.*', 'vehicles.*', 'vehicle_translations.name as vehicle_name', 'users.full_name as user_name', 'vehicle_categories.name as category_name')
                ->limit(3)
                ->get();
            $winner_bids = DB::table('vehicle_bids')
                ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
                ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
                ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
                ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('vehicle_bids.user_id', $user_id)
                ->where('vehicle_bids.is_winner', 1)
                ->select('vehicle_bids.*', 'vehicles.*', 'vehicle_translations.name as vehicle_name', 'users.full_name as user_name', 'vehicle_categories.name as category_name')
                ->limit(3)
                ->get();
            $my_bid_count = DB::table('vehicle_bids')
                ->where('vehicle_bids.user_id', $user_id)
                ->where('vehicle_bids.is_winner', 0)
                ->count();
            $winner_count = DB::table('vehicle_bids')
                ->where('vehicle_bids.user_id', $user_id)
                ->where('vehicle_bids.is_winner', 1)
                ->count();
            return view('website.profile.user_profile', [
                'user' => $user,
                'bids' => $bids,
                'winner_bids' => $winner_bids,
                'my_bid_count' => $my_bid_count,
                'winner_count' => $winner_count,
            ]);
        }
        abort(404);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->fname;
        $user->last_name = $request->lname;
        $user->full_name = $request->fname . ' ' . $request->lname;
        $user->save();

        return response()->json([
            'message' => trans('web_string.profile_update_successfully')
        ]);
    }

    public function changeImage(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($request->hasfile('image')) {
            $image = ImageUploadHelper::imageUpload($request->file('image'), 'profile');
            $user->image = $image;
        }
        $user->save();

        return response()->json([
            'message' => trans('web_string.profile_change_image_successfully')
        ]);
    }
}
