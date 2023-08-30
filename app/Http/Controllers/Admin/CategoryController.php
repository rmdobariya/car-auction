<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-read|category-create|category-update|category-delete', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $category = new Category();
            $category->name = $request->name;
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'), 'category');
                $category->image = $image;
            }
            $category->save();
            return response()->json([
                'message' => 'Category Add Successfully'
            ]);

        } else {
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'),'category');
                Category::where('id', $validated['edit_value'])->update([
                    'image' => $image
                ]);
            }
            $category = Category::find($validated['edit_value']);
            $category->name = $request->name;
            $category->save();

            return response()->json([
                'message' => 'Record Update Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Category::where('id', $id)->delete();
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }

    public function getCategoryList(Request $request)
    {
        if ($request->ajax()) {
            $category = DB::table('categories')
                ->orderBy('id', 'desc');

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
            $category = $category->select('categories.*');
            return Datatables::of($category)
                ->addColumn('action', function ($category) {

                    if (is_null($category->deleted_at)) {
                        $array = [
                            'id' => $category->id,
                            'actions' => [
                                'edit' => route('admin.category.edit', [$category->id]),
                                'delete' => $category->id,
                                'status' => $category->status,
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $category->id,
                            'actions' => [
                                'hard-delete' => $category->id,
                                'restore' => $category->id,
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
                        <input class="form-check-input" type="checkbox" value=' . $category->id . '>
                    </div>
                </td>';
                })
                ->addColumn('image', function ($category) {

                    return '<img src="' . asset($category->image) . '" style="width:50px">';
                })
                ->rawColumns(['action', 'status', 'check', 'image'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Category::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => 'Status Change Successfully',
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('categories')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Record Restore Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        $category = DB::table('categories')->where('id', $id)->first();
        if (file_exists(public_path() . "/" . $category->image)) {
            @unlink(public_path() . "/" . $category->image);
        }
        DB::table('categories')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }

    public function multipleCategoryDelete(Request $request): JsonResponse
    {
        Category::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }
}
