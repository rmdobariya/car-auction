<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogStoreRequest;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Testimonial;
use App\Models\TestimonialTranslation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:testimonial-read|testimonial-create|testimonial-update|testimonial-delete', ['only' => ['index']]);
        $this->middleware('permission:testimonial-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:testimonial-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:testimonial-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.testimonial.index');
    }

    public function create()
    {
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        return view('admin.testimonial.create', [
            'languages' => $languages
        ]);
    }

    public function store(BlogStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $testimonial = new Testimonial();
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'), 'testimonial');
                $testimonial->image = $image;
            }
            $testimonial->save();
            $languages = CatchCreateHelper::getLanguage(App::getLocale());
            foreach ($languages as $language) {
                TestimonialTranslation::create([
                    'title' => $request->input($language['language_code'] . '_title'),
                    'description' => $request->input($language['language_code'] . '_description'),
                    'testimonial_id' => $testimonial->id,
                    'locale' => $language['language_code'],
                ]);
            }
            return response()->json([
                'message' => 'Testimonial Add Successfully'
            ]);

        } else {
            if ($request->hasfile('image')) {
                $image = ImageUploadHelper::imageUpload($request->file('image'), 'testimonial');
                Testimonial::where('id', $validated['edit_value'])->update([
                    'image' => $image
                ]);
            }
            $testimonial = Testimonial::find($validated['edit_value']);
            $testimonial->save();
            $languages = CatchCreateHelper::getLanguage(App::getLocale());
            foreach ($languages as $language) {
                TestimonialTranslation::updateOrCreate(
                    [
                        'testimonial_id' => $validated['edit_value'],
                        'locale' => $language['language_code'],
                    ],
                    [
                        'testimonial_id' => $validated['edit_value'],
                        'locale' => $language['language_code'],
                        'title' => $request->input($language['language_code'] . '_title'),
                        'description' => $request->input($language['language_code'] . '_description'),
                    ]);
            }
            return response()->json([
                'message' => 'Testimonial Update Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        return view('admin.testimonial.edit', [
            'testimonial' => $testimonial,
            'languages' => $languages,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Testimonial::where('id', $id)->delete();
        return response()->json([
            'message' => 'Testimonial Delete Successfully'
        ]);
    }

    public function getTestimonialList(Request $request)
    {
        if ($request->ajax()) {
            $testimonial = DB::table('testimonials')
                ->leftJoin('testimonial_translations', 'testimonials.id', 'testimonial_translations.testimonial_id')
                ->where('testimonial_translations.locale', App::getLocale())
                ->orderBy('testimonials.id', 'desc');

            if (!empty($request->status) && $request->status !== 'all') {
                $testimonial->where('testimonials.status', $request->status);
            }

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $testimonial->whereNotNull('testimonials.deleted_at');
                } else {
                    $testimonial->whereNull('testimonials.deleted_at');

                }
            }
            $testimonial = $testimonial->select('testimonials.*', 'testimonial_translations.title', 'testimonial_translations.description');
            return Datatables::of($testimonial)
                ->addColumn('action', function ($testimonial) {

                    if (is_null($testimonial->deleted_at)) {
                        $array = [
                            'id' => $testimonial->id,
                            'actions' => [
                                'edit' => route('admin.testimonial.edit', [$testimonial->id]),
                                'delete' => $testimonial->id,
                                'status' => $testimonial->status,
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $testimonial->id,
                            'actions' => [
                                'hard-delete' => $testimonial->id,
                                'restore' => $testimonial->id,
                            ]
                        ];

                    }

                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($testimonial) {
                    $array['status'] = $testimonial->status;
                    return AdminDataTableButtonHelper::statusBadge($array);
                })
                ->addColumn('check', function ($testimonial) {

                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $testimonial->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->addColumn('image', function ($testimonial) {

                    return '<img src="' . asset($testimonial->image) . '" style="width:50px">';
                })
                ->rawColumns(['action', 'status', 'check', 'image'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Testimonial::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => 'Status Change Successfully',
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('testimonials')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Testimonial Restore Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        $testimonial =  DB::table('testimonials')->where('id', $id)->first();
        if (file_exists(public_path() . "/testimonial/" . $testimonial->image)) {
            @unlink(public_path() . "/testimonial/" . $testimonial->image);
        }
        DB::table('testimonials')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Testimonial Delete Successfully'
        ]);
    }

    public function multipleTestimonialDelete(Request $request): JsonResponse
    {
        $testimonials = DB::table('testimonials')->whereIn('id', $request->ids)->get();
        foreach ($testimonials as $testimonial) {
            if (!is_null($testimonial->deleted_at)) {
                if (file_exists(public_path() . "/testimonial/" . $testimonial->image)) {
                    @unlink(public_path() . "/testimonial/" . $testimonial->image);
                }
                DB::table('testimonials')->where('id', $testimonial->id)->delete();
            } else {
                Testimonial::where('id', $testimonial->id)->delete();
            }
        }
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }
}
