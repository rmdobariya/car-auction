<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\VehicleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale());
//            ->where('vehicles.status', 'approve');
        //        if (!is_null($request->condition)){
//
//        }
        if (!is_null($request->is_product)) {
            $vehicles->where('vehicles.is_product', $request->is_product);
        }
        if (!is_null($request->is_vehicle_type)) {
            $vehicles->where('vehicles.is_vehicle_type', $request->is_vehicle_type);
        }
        if (!is_null($request->category)) {
            $vehicles->where('vehicles.vehicle_category_id', $request->category_id);
        }
        if (!is_null($request->min_amount)) {
            $vehicles->where('vehicles.price', '>=', $request->min_amount);
        }
        if (!is_null($request->max_amount)) {
            $vehicles->where('vehicles.price', '<=', $request->max_amount);;

        }
        if (!is_null($request->model)) {
            $vehicles->where('vehicles.model', 'LIKE', '%' . $request->model . '%');
        }
        if (!is_null($request->body_type)) {
            $vehicles->where('vehicles.body_type', 'LIKE', '%' . $request->body_type . '%');
        }
        if (!is_null($request->exterior)) {
            $vehicles->whereIn('vehicles.color', explode(',', $request->exterior));
        }
        if (!is_null($request->ratting)) {
            $rat = explode('-', str_replace(' ', '', $request->ratting));
            $vehicles->where('vehicles.ratting', '>=', $rat[0])
                ->where('vehicles.ratting', '<=', $rat[1]);
        }
        $vehicles = $vehicles->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name','vehicle_translations.short_description','vehicle_translations.description', 'vehicle_categories.name as vehicle_category_name')
            ->get();
        $result = VehicleResource::collection($vehicles);
        return response()->json([
            'status' => true,
            'data' => ['Vehicle' => $result],
        ]);
    }
}
