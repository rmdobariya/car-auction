<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogStoreRequest;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:blog-read|blog-create|blog-update|blog-delete', ['only' => ['index']]);
        $this->middleware('permission:blog-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blog-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('admin.blog.index');
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(BlogStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->description = $request->description;
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'), 'blog');
                $blog->image = $image;
            }
            $blog->save();

            return response()->json([
                'message' => 'Blog Add Successfully'
            ]);

        } else {
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'));
                Blog::where('id', $validated['edit_value'])->update([
                    'image' => $image
                ]);
            }
            $blog = Blog::find($validated['edit_value']);
            $blog->title = $request->title;
            $blog->description = $request->description;

            $blog->save();

            return response()->json([
                'message' => 'Blog Update Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', [
            'blog' => $blog,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Blog::where('id', $id)->delete();
        return response()->json([
            'message' => 'Blog Delete Successfully'
        ]);
    }

    public function getBlogList(Request $request)
    {
        if ($request->ajax()) {
            $blog = DB::table('blogs')
                ->orderBy('id', 'desc');

            if (!empty($request->status) && $request->status !== 'all') {
                $blog->where('blogs.status', $request->status);
            }

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $blog->whereNotNull('blogs.deleted_at');
                } else {
                    $blog->whereNull('blogs.deleted_at');

                }
            }
            $blog = $blog->select('blogs.*');
            return Datatables::of($blog)
                ->addColumn('action', function ($blog) {

                    if (is_null($blog->deleted_at)) {
                        $array = [
                            'id' => $blog->id,
                            'actions' => [
                                'edit' => route('admin.blog.edit', [$blog->id]),
                                'delete' => $blog->id,
                                'status' => $blog->status,
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $blog->id,
                            'actions' => [
                                'hard-delete' => $blog->id,
                                'restore' => $blog->id,
                            ]
                        ];

                    }

                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($blog) {
                    $array['status'] = $blog->status;
                    return AdminDataTableButtonHelper::statusBadge($array);
                })
                ->addColumn('check', function ($blog) {

                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $blog->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->addColumn('image', function ($blog) {

                    return '<img src="' . asset($blog->image) . '" style="width:50px">';
                })
                ->rawColumns(['action', 'status', 'check', 'image'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Blog::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => 'Status Change Successfully',
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('blogs')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Blog Restore Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('blogs')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Blog Delete Successfully'
        ]);
    }

    public function multipleBlogDelete(Request $request): JsonResponse
    {
        Blog::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }
}
