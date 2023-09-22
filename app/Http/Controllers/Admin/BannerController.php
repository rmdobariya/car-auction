<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerStoreRequest;
use App\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class  BannerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:banner-read|banner-create|banner-update|category-delete', ['only' => ['index']]);
        $this->middleware('permission:banner-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:banner-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:banner-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.banner.index');
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(BannerStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $banner = new Banner();
            $banner->title = $request->title;
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'), 'banner');
                $banner->image = $image;
            }
            $banner->save();
            return response()->json([
                'message' => 'Record Add Successfully'
            ]);

        } else {
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'), 'banner');
                Banner::where('id', $validated['edit_value'])->update([
                    'image' => $image
                ]);
            }
            $banner = Banner::find($validated['edit_value']);
            $banner->title = $request->title;
            $banner->save();

            return response()->json([
                'message' => 'Record Update Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', [
            'banner' => $banner,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Banner::where('id', $id)->delete();
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }

    public function getBannerList(Request $request)
    {
        if ($request->ajax()) {
            $banner = DB::table('banners')
                ->orderBy('id', 'desc');

            if (!empty($request->status) && $request->status !== 'all') {
                $banner->where('banners.status', $request->status);
            }

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $banner->whereNotNull('banners.deleted_at');
                } else {
                    $banner->whereNull('banners.deleted_at');

                }
            }
            $banner = $banner->select('banners.*');
            return Datatables::of($banner)
                ->addColumn('action', function ($banner) {

                    if (is_null($banner->deleted_at)) {
                        $array = [
                            'id' => $banner->id,
                            'actions' => [
                                'edit' => route('admin.banner.edit', [$banner->id]),
                                'delete' => $banner->id,
                                'status' => $banner->status,
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $banner->id,
                            'actions' => [
                                'hard-delete' => $banner->id,
                                'restore' => $banner->id,
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($banner) {
                    $array['status'] = $banner->status;
                    return AdminDataTableButtonHelper::statusBadge($array);
                })
                ->addColumn('check', function ($banner) {

                    return '<td>
                     <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $banner->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->addColumn('image', function ($banner) {

                    return '<img src="' . asset($banner->image) . '" style="width:50px">';
                })
                ->rawColumns(['action', 'status', 'check', 'image'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Banner::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => 'Status Change Successfully',
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('banners')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Record Restore Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        $banner = DB::table('banners')->where('id', $id)->first();
        if (file_exists(public_path() . "/banner/" . $banner->image)) {
            @unlink(public_path() . "/banner/" . $banner->image);
        }
        DB::table('banners')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }

    public function multipleBannerDelete(Request $request): JsonResponse
    {
        $banners = DB::table('banners')->whereIn('id', $request->ids)->get();
        foreach ($banners as $banner) {
            if (!is_null($banner->deleted_at)) {
                if (file_exists(public_path() . "/banner/" . $banner->image)) {
                    @unlink(public_path() . "/banner/" . $banner->image);
                }
                DB::table('banners')->where('id', $banner->id)->delete();
            } else {
                Banner::where('id', $banner->id)->delete();
            }
        }
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }
}
