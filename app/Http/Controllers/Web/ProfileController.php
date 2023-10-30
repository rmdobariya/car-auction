<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ChangePasswordStoreRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                ->where('vehicles.auction_end_date', '>', date('Y-m-d'))
//                ->where('vehicle_bids.is_winner', 0)
                ->select('vehicle_bids.*', 'vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description','vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage',  'users.full_name as user_name', 'vehicle_categories.name as category_name')
                ->limit(3)
                ->get();
            $winner_bids = DB::table('vehicle_bids')
                ->leftJoin('vehicles', 'vehicle_bids.vehicle_id', 'vehicles.id')
                ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
                ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
                ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('vehicle_bids.user_id', $user_id)
                ->where('vehicles.auction_end_date', '<', date('Y-m-d'))
                ->where('vehicle_bids.is_winner', 1)
                ->select('vehicle_bids.*', 'vehicles.*', 'vehicle_translations.name as vehicle_name',
                    'vehicle_translations.description','vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage', 'users.full_name as user_name', 'vehicle_categories.name as category_name')
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

    public function updatePassword(ChangePasswordStoreRequest $request): JsonResponse
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $current_password = $request->current_password;
        $new_password = $request->new_password;
        if (!Hash::check($current_password, $user->password)) {
            return response()->json(['message' => trans('web_string.current_password_is_invalid')], 500);
        }
        User::where('id', $id)->update([
            'password' => bcrypt($new_password),
        ]);
        return response()->json(['message' => trans('web_string.password_change_successfully')]);
    }
}
