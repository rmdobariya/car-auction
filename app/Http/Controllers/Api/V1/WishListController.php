<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WishListStoreRequest;
use App\Http\Resources\WishlistResource;
use App\Models\WishList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class WishListController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $wishlist = DB::table('wish_lists')
            ->leftJoin('vehicles', 'wish_lists.vehicle_id', 'vehicles.id')
            ->leftJoin('vehicle_translations', 'wish_lists.vehicle_id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('wish_lists.user_id', $user->id)
            ->select('wish_lists.id as wishlist_id', 'wish_lists.vehicle_id as wishlist_vehicle_id', 'vehicle_translations.*', 'vehicles.*', 'category_translations.name as vehicle_category_name')
            ->get();
        if (count($wishlist) > 0) {
            $result = WishlistResource::collection($wishlist);
            return response()->json([
                'status' => true,
                'data' => ['Wishlist' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not Found',
                'data' => [],
            ]);
        }
    }

    public function store(WishListStoreRequest $request)
    {
        $user = $request->user();
        $vehicle_user_id = DB::table('vehicles')->where('id', $request->vehicle_id)->first()->user_id;
        if ($user->id != $vehicle_user_id) {
            $count = DB::table('wish_lists')->where('vehicle_id', $request->vehicle_id)->where('user_id', $user->id)->count();
            if ($count > 0) {
                DB::table('wish_lists')->where('vehicle_id', $request->vehicle_id)->where('user_id', $user->id)->delete();
                return response()->json([
                    'success' => true,
                    'is_wishlist' => 0,
                    'message' => trans('web_string.remove_in_wishlist_successfully'),
                ]);
            } else {
                $wish_list = new WishList();
                $wish_list->user_id = $user->id;
                $wish_list->vehicle_id = $request->vehicle_id;
                $wish_list->save();
                return response()->json([
                    'success' => true,
                    'is_wishlist' => 1,
                    'message' => trans('web_string.add_in_wishlist_successfully'),
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('web_string.you_can_not_add_your_car_to_the_wish_list'),
            ]);
        }
    }
}
