<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogStoreRequest;
use App\Models\Blog;
use App\Models\BlogTranslation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:news-read|news-create|news-update|news-delete|news-restore|news-status', ['only' => ['index']]);
        $this->middleware('permission:news-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:news-update', ['only' => ['edit','store']]);
        $this->middleware('permission:news-delete', ['only' => ['destroy','hardDelete','multipleBlogDelete']]);
        $this->middleware('permission:news-restore', ['only' => ['restore']]);
        $this->middleware('permission:news-status', ['only' => ['changeStatus']]);
    }

    public function index()
    {
        return view('admin.blog.index');
    }

    public function create()
    {
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        return view('admin.blog.create', [
            'languages' => $languages
        ]);
    }

    public function store(BlogStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $blog = new Blog();
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'), 'blog');
                $blog->image = $image;
            }
            $blog->save();
            $languages = CatchCreateHelper::getLanguage(App::getLocale());
            foreach ($languages as $language) {
                BlogTranslation::create([
                    'title' => $request->input($language['language_code'] . '_title'),
                    'description' => $request->input($language['language_code'] . '_description'),
                    'blog_id' => $blog->id,
                    'locale' => $language['language_code'],
                ]);
            }
            return response()->json([
                'message' => trans('admin_string.record_add_successfully')
            ]);

        } else {
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'),'blog');
                Blog::where('id', $validated['edit_value'])->update([
                    'image' => $image
                ]);
            }
            $blog = Blog::find($validated['edit_value']);
            $blog->save();
            $languages = CatchCreateHelper::getLanguage(App::getLocale());
            foreach ($languages as $language) {
                BlogTranslation::updateOrCreate(
                    [
                        'blog_id' => $validated['edit_value'],
                        'locale' => $language['language_code'],
                    ],
                    [
                        'blog_id' => $validated['edit_value'],
                        'locale' => $language['language_code'],
                        'title' => $request->input($language['language_code'] . '_title'),
                        'description' => $request->input($language['language_code'] . '_description'),
                    ]);
            }
            return response()->json([
                'message' => trans('admin_string.record_update_successfully')
            ]);
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        return view('admin.blog.edit', [
            'blog' => $blog,
            'languages' => $languages,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Blog::where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function getBlogList(Request $request)
    {
        if ($request->ajax()) {
            $blog = DB::table('blogs')
                ->leftJoin('blog_translations', 'blogs.id', 'blog_translations.blog_id')
                ->where('blog_translations.locale', App::getLocale())
                ->orderBy('blogs.id', 'desc');

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
            $blog = $blog->select('blogs.*', 'blog_translations.title', 'blog_translations.description');
            return Datatables::of($blog)
                ->addColumn('action', function ($blog) {

                    if (is_null($blog->deleted_at)) {
                        $array = [
                            'id' => $blog->id,
                            'actions' => [
                                'edit' => route('admin.news.edit', [$blog->id]),
                                'delete' => $blog->id,
                                'status' => $blog->status,
                                'edit_permission' => Auth::user()->can('news-update'),
                                'delete_permission' => Auth::user()->can('news-delete'),
                                'status_permission' => Auth::user()->can('news-status'),
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $blog->id,
                            'actions' => [
                                'hard-delete' => $blog->id,
                                'restore' => $blog->id,
                                'delete_permission' => Auth::user()->can('news-delete'),
                                'restore_permission' => Auth::user()->can('news-restore'),
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
            'message' => trans('admin_string.status_change_successfully'),
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('blogs')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => trans('admin_string.record_restore_successfully')
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        if (file_exists(public_path() . "/blog/" . $blog->image)) {
            @unlink(public_path() . "/blog/" . $blog->image);
        }
        DB::table('blogs')->where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function multipleBlogDelete(Request $request): JsonResponse
    {
        $blogs = DB::table('blogs')->whereIn('id', $request->ids)->get();
        foreach ($blogs as $blog) {
            if (!is_null($blog->deleted_at)) {
                if (file_exists(public_path() . "/blog/" . $blog->image)) {
                    @unlink(public_path() . "/blog/" . $blog->image);
                }
                DB::table('blogs')->where('id', $blog->id)->delete();
            } else {
                Blog::where('id', $blog->id)->delete();
            }
        }
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }
}
