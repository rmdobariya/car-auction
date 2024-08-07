<?php

namespace App\Http\Controllers\Admin;


use App\Exports\VehicleExport;
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
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:vehicle-read|vehicle-create|vehicle-update|vehicle-delete|vehicle-restore|vehicle-status|vehicle-detail', ['only' => ['index']]);
        $this->middleware('permission:vehicle-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:vehicle-update', ['only' => ['edit', 'update', 'store']]);
        $this->middleware('permission:vehicle-delete', ['only' => ['destroy', 'hardDelete', 'multipleVehicleDelete']]);
        $this->middleware('permission:vehicle-restore', ['only' => ['restore']]);
        $this->middleware('permission:vehicle-status', ['only' => ['changeStatus']]);
        $this->middleware('permission:vehicle-detail', ['only' => ['show']]);
    }

    public function index()
    {
        return view('admin.vehicle.index');
    }

    public function create()
    {
        $user = Auth::user();

        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        $vehicle_categories = DB::table('categories')
            ->leftjoin('category_translations', 'categories.id', 'category_translations.category_id')
            ->where('categories.status', 'active')
            ->where('category_translations.locale', App::getLocale())
            ->whereNull('deleted_at')
            ->select('categories.*', 'category_translations.name')
            ->get();
        if ($user->is_sub_admin == 0) {
            $users = User::where('id', '!=', 1)->whereNull('deleted_at')->get();
        } else {
            $users = User::where('id', '!=', 1)->where('user_type', 'seller')->whereNull('deleted_at')->get();
        }
        return view('admin.vehicle.create', [
            'vehicle_categories' => $vehicle_categories,
            'users' => $users,
            'languages' => $languages,
        ]);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        $vehicle_categories = DB::table('categories')
            ->leftjoin('category_translations', 'categories.id', 'category_translations.category_id')
            ->where('categories.status', 'active')
            ->where('category_translations.locale', App::getLocale())
            ->whereNull('deleted_at')
            ->select('categories.*', 'category_translations.name')
            ->get();
        if ($user->is_sub_admin == 0) {
            $users = User::where('id', '!=', 1)->whereNull('deleted_at')->get();
        } else {
            $users = User::where('id', '!=', 1)->where('user_type', 'seller')->whereNull('deleted_at')->get();
        }
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
            'message' => trans('admin_string.record_delete_successfully')
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
                                'vehicle-status' => $vehicle->status,
                                'edit_permission' => Auth::user()->can('vehicle-update'),
                                'delete_permission' => Auth::user()->can('vehicle-delete'),
                                'status_permission' => Auth::user()->can('vehicle-status'),
                                'detail_permission' => Auth::user()->can('vehicle-detail'),
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $vehicle->id,
                            'actions' => [
                                'hard-delete' => $vehicle->id,
                                'restore' => $vehicle->id,
                                'delete_permission' => Auth::user()->can('vehicle-delete'),
                                'restore_permission' => Auth::user()->can('vehicle-restore'),
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($vehicle) {
                    $array['status'] = $vehicle->status;
                    return AdminDataTableButtonHelper::vehicleStatusBadge($array);
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
            'message' => trans('admin_string.status_change_successfully'),
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('vehicles')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => trans('admin_string.record_restore_successfully')
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
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function show($id)
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('users', 'vehicles.user_id', 'users.id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->leftjoin('roles', 'model_has_roles.role_id', 'roles.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('vehicles.id', $id)
            ->select('vehicles.*', 'users.name as user_name', 'category_translations.name as category_name', 'roles.name as role_name', 'vehicle_translations.*')
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
            'message' => trans('admin_string.record_delete_successfully')
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
                $vehicle->kms_driven = $request->kms_driven;
                $vehicle->owners = $request->owners;
                $vehicle->price = $request->price;
                $vehicle->bid_increment = $request->bid_increment;
                $vehicle->is_product = $request['is_product'];
                $vehicle->auction_start_date = $request->auction_start_date;
                $vehicle->auction_end_date = $request->auction_end_date;
                $vehicle->auction_start_time = $request->auction_start_time;
                $vehicle->auction_end_time = $request->auction_end_time;
                $vehicle->advance_payment = $request->advance_payment;
                $vehicle->advance_payment_type = $request->advance_payment_type;
                if ($request->hasfile('image')) {
                    $image = ImageUploadHelper::imageUpload($request->file('image'), 'vehicle');
                    $vehicle->main_image = $image;
                }
                if ($request->hasfile('car_report')) {
                    $car_report = ImageUploadHelper::imageUpload($request->file('car_report'), 'vehicle');
                    $vehicle->car_report = $car_report;
                }
                $vehicle->save();
                $languages = CatchCreateHelper::getLanguage(App::getLocale());
                foreach ($languages as $language) {
                    VehicleTranslation::create([
                        'name' => $request->input($language['language_code'] . '_name'),
//                        'short_description' => $request->input($language['language_code'] . '_short_description'),
                        'make' => $request->input($language['language_code'] . '_make'),
                        'model' => $request->input($language['language_code'] . '_model'),
                        'trim' => $request->input($language['language_code'] . '_trim'),
                        'transmission' => $request->input($language['language_code'] . '_transmission'),
                        'fuel_type' => $request->input($language['language_code'] . '_fuel_type'),
                        'body_type' => $request->input($language['language_code'] . '_body_type'),
                        'registration' => $request->input($language['language_code'] . '_registration'),
                        'color' => $request->input($language['language_code'] . '_color'),
                        'car_type' => $request->input($language['language_code'] . '_car_type'),
                        'mileage' => $request->input($language['language_code'] . '_mileage'),
                        'description' => $request->input($language['language_code'] . '_description'),
                        'vehicle_id' => $vehicle->id,
                        'locale' => $language['language_code'],
                    ]);
                }
                $m_images = TempImage::where('temp_time', $request->temp_time)->get();
                ImageUploadHelper::UploadMultipleImage($m_images, $vehicle->id);

                TempImage::where('temp_time', $request->temp_time)->delete();
                DB::commit();
                return response()->json(['message' => trans('admin_string.record_add_successfully')]);
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
                $vehicle->kms_driven = $request->kms_driven;
                $vehicle->owners = $request->owners;
                $vehicle->price = $request->price;
                $vehicle->bid_increment = $request->bid_increment;
                $vehicle->is_product = $request['is_product'];
                $vehicle->auction_start_date = $request->auction_start_date;
                $vehicle->auction_end_date = $request->auction_end_date;
                $vehicle->auction_start_time = $request->auction_start_time;
                $vehicle->auction_end_time = $request->auction_end_time;
                $vehicle->advance_payment = $request->advance_payment;
                $vehicle->advance_payment_type = $request->advance_payment_type;
                if ($request->hasfile('image')) {
                    $image = ImageUploadHelper::imageUpload($request->file('image'), 'vehicle');
                    $vehicle->main_image = $image;
                }
                if ($request->hasfile('car_report')) {
                    $car_report = ImageUploadHelper::imageUpload($request->file('car_report'), 'vehicle');
                    $vehicle->car_report = $car_report;
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
//                            'short_description' => $request->input($language['language_code'] . '_short_description'),
                            'make' => $request->input($language['language_code'] . '_make'),
                            'model' => $request->input($language['language_code'] . '_model'),
                            'trim' => $request->input($language['language_code'] . '_trim'),
                            'transmission' => $request->input($language['language_code'] . '_transmission'),
                            'fuel_type' => $request->input($language['language_code'] . '_fuel_type'),
                            'body_type' => $request->input($language['language_code'] . '_body_type'),
                            'registration' => $request->input($language['language_code'] . '_registration'),
                            'color' => $request->input($language['language_code'] . '_color'),
                            'car_type' => $request->input($language['language_code'] . '_car_type'),
                            'mileage' => $request->input($language['language_code'] . '_mileage'),
                            'description' => $request->input($language['language_code'] . '_description'),
                        ]);
                }
                $m_images = TempImage::where('temp_time', $request->temp_time)->get();
                ImageUploadHelper::UploadMultipleImage($m_images, $vehicle->id);
                TempImage::where('temp_time', $request->temp_time)->delete();

                DB::commit();
                return response()->json(['message' => trans('admin_string.record_update_successfully')]);
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
        return response()->json(['success' => true, 'message' => trans('admin_string.image_delete_successfully')]);

    }

    public function vehicleExport(Request $request): JsonResponse
    {
        $vehicle = DB::table('vehicles')
            ->leftJoin('users', 'vehicles.user_id', 'users.id')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('category_translations', 'vehicles.vehicle_category_id', 'category_translations.category_id')
            ->leftJoin('city_translations', 'vehicles.city_id', 'city_translations.city_id')
            ->leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->leftjoin('roles', 'model_has_roles.role_id', 'roles.id')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('category_translations.locale', App::getLocale())
            ->where('city_translations.locale', App::getLocale())
            ->orderBy('id', 'desc');

        if (!is_null($request->status)) {
            $vehicle->where('vehicles.status', $request->status);
        }

        if (!empty($request->deleted)) {
            if ((int)$request->deleted === 1) {
                $vehicle->whereNotNull('vehicles.deleted_at');
            } else {
                $vehicle->whereNull('vehicles.deleted_at');
            }
        }
        $vehicle = $vehicle->select('vehicles.*', 'users.name as user_name', 'users.user_type as user_type', 'category_translations.name as vehicle_category', 'city_translations.name as city', 'vehicle_translations.name as name')->get();
        Excel::store(new VehicleExport($vehicle), 'Vehicle.xlsx', 'excel_uploads');
        return response()->json(['url' => url('assets/uploads/Vehicle.xlsx')]);
    }


    public function getVehicleWiseBidList(Request $request, $id)
    {
        if ($request->ajax()) {
            $vehicle_bids = DB::table('vehicle_bids')
                ->leftJoin('users', 'vehicle_bids.user_id', 'users.id')
                ->leftJoin('vehicle_translations', 'vehicle_bids.vehicle_id', 'vehicle_translations.vehicle_id')
                ->where('vehicle_translations.locale', App::getLocale())
                ->where('vehicle_bids.vehicle_id', $id)
                ->orderBy('vehicle_bids.id', 'desc')
                ->select('vehicle_bids.*', 'users.name as user_name', 'vehicle_translations.name as vehicle_name');
            return Datatables::of($vehicle_bids)
                ->addColumn('bid_time', function ($vehicle_bids) {
                    return Carbon::parse($vehicle_bids->created_at)->format('d-m-Y h:i A');
                })
                ->addColumn('is_winner', function ($vehicle_bids) {
                    if ($vehicle_bids->is_winner == 1) {
                        $is_winner = '<div class="badge badge-light-success">' . trans('admin_string.yes') . '</div>';
                    } else {
                        $is_winner = '<div class="badge badge-light-danger">' . trans('admin_string.no') . '</div>';
                    }
                    return $is_winner;
                })

                ->rawColumns(['is_winner'])
                ->make(true);
        }
    }
}
