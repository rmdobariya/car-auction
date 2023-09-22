<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\VehicleStoreRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\CityTranslation;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\TempImage;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleDocument;
use App\Models\VehicleImage;
use App\Models\VehicleTranslation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:vehicle-read|vehicle-create|vehicle-update|vehicle -delete', ['only' => ['index']]);
        $this->middleware('permission:vehicle-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:vehicle-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:vehicle-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.vehicle.index');
    }

    public function create()
    {
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        $vehicle_categories = VehicleCategory::whereNull('deleted_at')->get();
        $users = User::where('id', '!=', 1)->whereNull('deleted_at')->get();
        return view('admin.vehicle.create', [
            'vehicle_categories' => $vehicle_categories,
            'users' => $users,
            'languages' => $languages,
        ]);
    }

    public function edit($id)
    {
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        $vehicle_categories = VehicleCategory::whereNull('deleted_at')->get();
        $users = User::where('id', '!=', 1)->whereNull('deleted_at')->get();
        $vehicleImages = VehicleImage::where('vehicle_id', $id)->get();
        $vehicle = Vehicle::where('id', $id)->first();
        return view('admin.vehicle.edit', [
            'vehicle_categories' => $vehicle_categories,
            'users' => $users,
            'vehicle' => $vehicle,
            'vehicleImages' => $vehicleImages,
            'languages' => $languages,
        ]);
    }


    public function destroy($id): JsonResponse
    {
        Vehicle::where('id', $id)->delete();
        return response()->json([
            'message' => 'Vehicle Delete Successfully'
        ]);
    }

    public function getVehicleList(Request $request)
    {
        if ($request->ajax()) {
            $vehicle = DB::table('vehicles')
                ->leftJoin('users', 'vehicles.user_id', 'users.id')
                ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
                ->leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
                ->leftjoin('roles', 'model_has_roles.role_id', 'roles.id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->orderBy('id', 'desc');

            if (!empty($request->status) && $request->status !== 'all') {
                $vehicle->where('vehicles.status', $request->status);
            }

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $vehicle->whereNotNull('vehicles.deleted_at');
                } else {
                    $vehicle->whereNull('vehicles.deleted_at');
                }
            }
            $vehicle = $vehicle->select('vehicles.*', 'users.name as user_name', 'users.user_type as user_type', 'roles.name as role_name', 'vehicle_translations.name as name');
            return Datatables::of($vehicle)
                ->addColumn('action', function ($vehicle) {

                    if (is_null($vehicle->deleted_at)) {
                        $array = [
                            'id' => $vehicle->id,
                            'actions' => [
                                'edit' => route('admin.vehicle.edit', [$vehicle->id]),
                                'detail-page' => route('admin.vehicle.show', [$vehicle->id]),
                                'delete' => $vehicle->id,
                                'status' => $vehicle->status,
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $vehicle->id,
                            'actions' => [
                                'hard-delete' => $vehicle->id,
                                'restore' => $vehicle->id,
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($vehicle) {
                    $array['status'] = $vehicle->status;
                    return AdminDataTableButtonHelper::statusBadge($array);
                })
                ->addColumn('check', function ($vehicle) {

                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $vehicle->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->addColumn('image', function ($vehicle) {

                    return '<img src="' . asset($vehicle->main_image) . '" style="width:50px">';
                })
                ->rawColumns(['action', 'status', 'check', 'image'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Vehicle::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => 'Status Change Successfully',
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('vehicles')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Vehicle Restore Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        $vehicle = DB::table('vehicles')->where('id', $id)->first();
        if (file_exists(public_path() . "/vehicle/" . $vehicle->main_image)) {
            @unlink(public_path() . "/vehicle/" . $vehicle->main_image);
        }
        DB::table('vehicles')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Vehicle Delete Successfully'
        ]);
    }

    public function show($id)
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('users', 'vehicles.user_id', 'users.id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->leftjoin('roles', 'model_has_roles.role_id', 'roles.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
            ->orderBy('id', 'desc')
            ->select('vehicles.*', 'users.name as user_name', 'vehicle_categories.name as category_name', 'roles.name as role_name', 'vehicle_translations.name as vehicle_name','vehicle_translations.short_description as t_short_description','vehicle_translations.description as t_description')
            ->first();
        $vehicle_images = VehicleImage::where('vehicle_id', $id)->get();
        $vehicle_documents = VehicleDocument::where('vehicle_id', $id)->get();
        return view('admin.vehicle.show', [
            'vehicle' => $vehicle,
            'vehicle_images' => $vehicle_images,
            'vehicle_documents' => $vehicle_documents,
        ]);
    }

    public function multipleVehicleDelete(Request $request): JsonResponse
    {
        $vehicles = DB::table('vehicles')->whereIn('id', $request->ids)->get();
        foreach ($vehicles as $vehicle) {
            if (!is_null($vehicle->deleted_at)) {
                if (file_exists(public_path() . "/vehicle/" . $vehicle->main_image)) {
                    @unlink(public_path() . "/vehicle/" . $vehicle->main_image);
                }
                DB::table('vehicles')->where('id', $vehicle->id)->delete();
            } else {
                Vehicle::where('id', $vehicle->id)->delete();
            }
        }
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }

    public function imageUpload(Request $request): \Illuminate\Http\JsonResponse
    {

        $files = $request->qqfile;
        $image_path = 'uploads/' . date('Y') . '/' . date('m');
        $extension = $files->getClientOriginalExtension();
        $image_name = $image_path . '/' . uniqid() . '.' . $extension;
        $files->move($image_path, $image_name);
        $tmpImage = new TempImage();
        $tmpImage->name = $image_name;
        $tmpImage->temp_id = $request->qquuid;
        $tmpImage->temp_time = $request->temp_time;
        $tmpImage->save();
        return response()->json([
            'success' => true,
        ]);
    }

    function imageDelete($id)
    {
        $image = TempImage::where('temp_id', $id)->first()->name;
        ImageUploadHelper::deleteImage($image);
        TempImage::where('temp_id', $id)->delete();
    }

    public function store(VehicleStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        DB::beginTransaction();
        if ((int)$validated['edit_value'] === 0) {
            try {
                $vehicle = new Vehicle();
                $vehicle->user_id = $request->user_id;
                $vehicle->vehicle_category_id = $request->vehicle_category_id;
                $vehicle->year = $request->year;
                $vehicle->make = $request->make;
                $vehicle->model = $request->model;
                $vehicle->trim = $request->trim;
                $vehicle->kms_driven = $request->kms_driven;
                $vehicle->owners = $request->owners;
                $vehicle->transmission = $request->transmission;
                $vehicle->fuel_type = $request->fuel_type;
                $vehicle->body_type = $request->body_type;
                $vehicle->registration = $request->registration;
                $vehicle->mileage = $request->mileage;
                $vehicle->price = $request->price;
//                $vehicle->short_description = $request->short_description;
//                $vehicle->description = $request->description;
                $vehicle->minimum_bid_increment_price = $request->minimumBidIncrement;
                $vehicle->auction_start_date = $request->auction_start_date;
                $vehicle->auction_end_date = $request->auction_end_date;
                $vehicle->auction_start_time = $request->auction_start_time;
                $vehicle->auction_end_time = $request->auction_end_time;
                if ($request->hasfile('image')) {
                    $image = ImageUploadHelper::imageUpload($request->file('image'), 'vehicle');
                    $vehicle->main_image = $image;
                }
                $vehicle->save();
                $languages = CatchCreateHelper::getLanguage(App::getLocale());
                foreach ($languages as $language) {
                    VehicleTranslation::create([
                        'name' => $request->input($language['language_code'] . '_name'),
                        'short_description' => $request->input($language['language_code'] . '_short_description'),
                        'description' => $request->input($language['language_code'] . '_description'),
                        'vehicle_id' => $vehicle->id,
                        'locale' => $language['language_code'],
                    ]);
                }
                $m_images = TempImage::where('temp_time', $request->temp_time)->get();
                ImageUploadHelper::UploadMultipleImage($m_images, $vehicle->id);

                TempImage::where('temp_time', $request->temp_time)->delete();
                DB::commit();
                return response()->json(['message' => "Vehicle Added Successfully"]);
            } catch
            (\Exception $exception) {
                DB::rollback();
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 522);
            }
        } else {
            try {
                $vehicle = Vehicle::find($validated['edit_value']);
                $vehicle->user_id = $request->user_id;
                $vehicle->vehicle_category_id = $request->vehicle_category_id;
                $vehicle->year = $request->year;
                $vehicle->make = $request->make;
                $vehicle->model = $request->model;
                $vehicle->trim = $request->trim;
                $vehicle->kms_driven = $request->kms_driven;
                $vehicle->owners = $request->owners;
                $vehicle->transmission = $request->transmission;
                $vehicle->fuel_type = $request->fuel_type;
                $vehicle->body_type = $request->body_type;
                $vehicle->registration = $request->registration;
                $vehicle->mileage = $request->mileage;
                $vehicle->price = $request->price;
//                $vehicle->short_description = $request->short_description;
//                $vehicle->description = $request->description;
                $vehicle->minimum_bid_increment_price = $request->minimumBidIncrement;
                $vehicle->auction_start_date = $request->auction_start_date;
                $vehicle->auction_end_date = $request->auction_end_date;
                $vehicle->auction_start_time = $request->auction_start_time;
                $vehicle->auction_end_time = $request->auction_end_time;
                if ($request->hasfile('image')) {
                    $image = ImageUploadHelper::imageUpload($request->file('image'), 'vehicle');
                    $vehicle->main_image = $image;
                }
                $vehicle->save();
                $languages = CatchCreateHelper::getLanguage(App::getLocale());
                foreach ($languages as $language) {
                    VehicleTranslation::updateOrCreate(
                        [
                            'vehicle_id' => $validated['edit_value'],
                            'locale' => $language['language_code'],
                        ],
                        [
                            'vehicle_id' => $validated['edit_value'],
                            'locale' => $language['language_code'],
                            'name' => $request->input($language['language_code'] . '_name'),
                            'description' => $request->input($language['language_code'] . '_description'),
                            'short_description' => $request->input($language['language_code'] . '_short_description'),
                        ]);
                }
                $m_images = TempImage::where('temp_time', $request->temp_time)->get();
                ImageUploadHelper::UploadMultipleImage($m_images, $vehicle->id);
                TempImage::where('temp_time', $request->temp_time)->delete();

                DB::commit();
                return response()->json(['message' => 'Vehicle Updated Successfully']);
            } catch
            (\Exception $exception) {
                DB::rollback();
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 522);
            }
        }
    }

    public function getVehicleGallery(Request $request)
    {
        $id = $request['product_id'];
        $vehicleImages = VehicleImage::where('vehicle_id', $id)->get();
        $view = view('admin.vehicle.gallery', [
            'vehicleImages' => $vehicleImages
        ])->render();

        return response()->json([
            'data' => $view
        ]);
    }

    public function deleteVehicleImage($id)
    {
        $image = VehicleImage::where('id', $id)->first();
        if ($image) {
            ImageUploadHelper::deleteImage($image->image);
            VehicleImage::where('id', $id)->delete();
        }
        return response()->json(['success' => true, 'message' => 'Image Delete Successfully']);

    }

}
