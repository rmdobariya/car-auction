<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleDocumentUploadStoreRequest;
use App\Http\Resources\VehicleResource;
use App\Models\VehicleDocument;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VehicleDocumentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $vehicle = DB::table('vehicles')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->where('vehicles.user_id', $user->id)
            ->whereNull('vehicles.deleted_at');
        if (!is_null($request->name)) {
            $vehicle = $vehicle->where('vehicles.name', 'like', '%' . $request->name . '%');
        }
        if (!is_null($request->status)) {
            $vehicle = $vehicle->where('vehicles.status', 'like', '%' . $request->status . '%');
        }
        if (!is_null($request->vehicle_category_id)) {
            $vehicle = $vehicle->where('vehicles.vehicle_category_id', 'like', '%' . $request->vehicle_category_id . '%');
        }
        $vehicle = $vehicle->select('vehicles.*', 'vehicle_categories.name as vehicle_category_name')
            ->get();
        $result = VehicleResource::collection($vehicle);
        return response()->json([
            'status' => true,
            'data' => ['vehicle_document' => $result],
        ]);
    }

    public function documentUpload(VehicleDocumentUploadStoreRequest $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            if ($request->hasfile('document')) {
                foreach ($request->file('document') as $key => $files) {
                    $image_path = 'vehicle-document-' . $request->vehicle_id;
                    if (!File::exists(public_path() . "/" . $image_path)) {
                        File::makeDirectory(public_path() . "/" . $image_path, 0777, true);
                    }
                    $image_name = $files->getClientOriginalName();
                    $destination_path = public_path() . '/' . $image_path;
                    $file_name = uniqid() . '-' . $image_name;
                    $files->move($destination_path, $file_name);
                    $document = $image_path . '/' . $file_name;
                    $vehicle_image = new VehicleDocument();
                    $vehicle_image->vehicle_id = $request->vehicle_id;
                    $vehicle_image->title = $request->title[$key];
                    $vehicle_image->document = $document;
                    $vehicle_image->save();
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Vehicle Document Insert Successfully',
            ]);
        }
    }

    public function removeDocument($id)
    {
        $vehicle_document = DB::table('vehicle_documents')->where('id', $id)->first();
        ImageUploadHelper::deleteImage($vehicle_document->document);
        DB::table('vehicle_documents')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Vehicle Document Delete Successfully',
        ]);
    }

}
