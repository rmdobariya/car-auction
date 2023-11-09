<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale());
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
            $vehicles->where('vehicle_translations.model', 'LIKE', '%' . $request->model . '%');
        }
        if (!is_null($request->body_type)) {
            $vehicles->where('vehicle_translations.body_type', 'LIKE', '%' . $request->body_type . '%');
        }
        if (!is_null($request->exterior)) {
            $vehicles->whereIn('vehicle_translations.color', explode(',', $request->exterior));
        }
        if (!is_null($request->ratting)) {
            $rat = explode('-', str_replace(' ', '', $request->ratting));
            $vehicles->where('vehicles.ratting', '>=', $rat[0])
                ->where('vehicles.ratting', '<=', $rat[1]);
        }
        $vehicles = $vehicles->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'category_translations.name as vehicle_category_name', 'vehicle_translations.name  as vehicle_name',
                'vehicle_translations.description', 'vehicle_translations.short_description', 'vehicle_translations.make', 'vehicle_translations.model', 'vehicle_translations.trim', 'vehicle_translations.transmission', 'vehicle_translations.fuel_type', 'vehicle_translations.body_type', 'vehicle_translations.registration', 'vehicle_translations.color', 'vehicle_translations.car_type', 'vehicle_translations.mileage')
            ->get();
        if (count($vehicles) > 0) {
            $result = VehicleResource::collection($vehicles);
            return response()->json([
                'status' => true,
                'data' => ['Vehicle' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not  Found',
                'data' => [],
            ]);
        }

    }
}
