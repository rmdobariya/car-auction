<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\VehicleTranslation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-read|category-create|category-update|category-delete|category-restore|category-status', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-update', ['only' => ['edit', 'update','store']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy','multipleCategoryDelete','hardDelete']]);
        $this->middleware('permission:category-restore', ['only' => ['restore']]);
        $this->middleware('permission:category-status', ['only' => ['changeStatus']]);
    }

    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        return view('admin.category.create', [
            'languages' => $languages
        ]);
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        if ((int)$validated['edit_value'] === 0) {
            $category = new Category();
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'), 'category');
                $category->image = $image;
            }
            $category->save();

            foreach ($languages as $language) {
                CategoryTranslation::create([
                    'name' => $request->input($language['language_code'] . '_name'),
                    'category_id' => $category->id,
                    'locale' => $language['language_code'],
                ]);
            }
            return response()->json([
                'message' => trans('admin_string.record_add_successfully')
            ]);

        } else {
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'), 'category');
                Category::where('id', $validated['edit_value'])->update([
                    'image' => $image
                ]);
            }
            $category = Category::find($validated['edit_value']);
            $category->save();
            foreach ($languages as $language) {
                CategoryTranslation::updateOrCreate(
                    [
                        'category_id' => $validated['edit_value'],
                        'locale' => $language['language_code'],
                    ],
                    [
                        'category_id' => $validated['edit_value'],
                        'locale' => $language['language_code'],
                        'name' => $request->input($language['language_code'] . '_name'),
                    ]);
            }
            return response()->json([
                'message' => trans('admin_string.record_update_successfully')
            ]);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        return view('admin.category.edit', [
            'category' => $category,
            'languages' => $languages,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Category::where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function getCategoryList(Request $request)
    {
        if ($request->ajax()) {
            $category = DB::table('categories')
                ->leftJoin('category_translations', 'categories.id', 'category_translations.category_id')
                ->where('category_translations.locale', App::getLocale())
                ->orderBy('categories.id', 'desc');

            if (!empty($request->status) && $request->status !== 'all') {
                $category->where('categories.status', $request->status);
            }

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $category->whereNotNull('categories.deleted_at');
                } else {
                    $category->whereNull('categories.deleted_at');

                }
            }
            $category = $category->select('categories.*','category_translations.name');
            return Datatables::of($category)
                ->addColumn('action', function ($category) {

                    if (is_null($category->deleted_at)) {
                        $array = [
                            'id' => $category->id,
                            'actions' => [
                                'edit' => route('admin.category.edit', [$category->id]),
                                'delete' => $category->id,
                                'status' => $category->status,
                                'edit_permission' => Auth::user()->can('category-update'),
                                'delete_permission' => Auth::user()->can('category-delete'),
                                'status_permission' => Auth::user()->can('category-status'),
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $category->id,
                            'actions' => [
                                'hard-delete' => $category->id,
                                'restore' => $category->id,
                                'delete_permission' => Auth::user()->can('category-delete'),
                                'restore_permission' => Auth::user()->can('category-restore'),
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($category) {
                    $array['status'] = $category->status;
                    return AdminDataTableButtonHelper::statusBadge($array);
                })
                ->addColumn('check', function ($category) {

                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $category->id . ' id="single_select">
                    </div>
                </td>';
                })
//                ->addColumn('image', function ($category) {
//
//                    return '<img src="' . asset($category->image) . '" style="width:50px">';
//                })
                ->rawColumns(['action', 'status', 'check'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Category::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => trans('admin_string.status_change_successfully'),
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('categories')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => trans('admin_string.record_restore_successfully')
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        $category = DB::table('categories')->where('id', $id)->first();
        if (file_exists(public_path() . "/category/" . $category->image)) {
            @unlink(public_path() . "/category/" . $category->image);
        }
        DB::table('categories')->where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function multipleCategoryDelete(Request $request): JsonResponse
    {
        $categories = DB::table('categories')->whereIn('id', $request->ids)->get();
        foreach ($categories as $category) {
            if (!is_null($category->deleted_at)) {
                if (file_exists(public_path() . "/category/" . $category->image)) {
                    @unlink(public_path() . "/category/" . $category->image);
                }
                DB::table('categories')->where('id', $category->id)->delete();
            } else {
                Category::where('id', $category->id)->delete();
            }
        }
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }
}
