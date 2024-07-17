<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqStoreRequest;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:faq-read|faq-create|faq-update|faq-delete', ['only' => ['index']]);
        $this->middleware('permission:faq-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faq-update', ['only' => ['edit', 'update','store']]);
        $this->middleware('permission:faq-delete', ['only' => ['destroy','hardDelete','multipleFaqDelete']]);
        $this->middleware('permission:faq-restore', ['only' => ['restore']]);
        $this->middleware('permission:faq-status', ['only' => ['changeStatus']]);
    }

    public function index()
    {
        return view('admin.faq.index');
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(FaqStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $faq = new Faq();
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return response()->json([
                'message' => trans('admin_string.record_add_successfully')
            ]);

        } else {
            $faq = Faq::find($validated['edit_value']);
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return response()->json([
                'message' => trans('admin_string.record_update_successfully')
            ]);
        }
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', [
            'faq' => $faq,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Faq::where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function getFaqList(Request $request)
    {
        if ($request->ajax()) {
            $faq = DB::table('faqs')
                ->orderBy('id', 'desc');

            if (!empty($request->status) && $request->status !== 'all') {
                $faq->where('faqs.status', $request->status);
            }

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $faq->whereNotNull('faqs.deleted_at');
                } else {
                    $faq->whereNull('faqs.deleted_at');

                }
            }
            $faq = $faq->select('faqs.*');
            return Datatables::of($faq)
                ->addColumn('action', function ($faq) {

                    if (is_null($faq->deleted_at)) {
                        $array = [
                            'id' => $faq->id,
                            'actions' => [
                                'edit' => route('admin.faq.edit', [$faq->id]),
                                'delete' => $faq->id,
                                'status' => $faq->status,
                                'edit_permission' => Auth::user()->can('faq-update'),
                                'delete_permission' => Auth::user()->can('faq-delete'),
                                'status_permission' => Auth::user()->can('faq-status'),
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $faq->id,
                            'actions' => [
                                'hard-delete' => $faq->id,
                                'restore' => $faq->id,
                                'delete_permission' => Auth::user()->can('faq-delete'),
                                'restore_permission' => Auth::user()->can('faq-restore'),
                            ]
                        ];

                    }

                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($faq) {
                    $array['status'] = $faq->status;
                    return AdminDataTableButtonHelper::statusBadge($array);
                })
                ->addColumn('check', function ($faq) {

                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $faq->id . ' id="single_select">
                    </div>
                </td>';


                })
                ->rawColumns(['action', 'status', 'check'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Faq::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => trans('admin_string.status_change_successfully'),
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('faqs')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => trans('admin_string.record_restore_successfully')
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('faqs')->where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function multipleFaqDelete(Request $request): JsonResponse
    {
        $faqs = DB::table('faqs')->whereIn('id', $request->ids)->get();
        foreach ($faqs as $faq) {
            if (!is_null($faq->deleted_at)) {
                DB::table('faqs')->where('id', $faq->id)->delete();
            } else {
                Faq::where('id', $faq->id)->delete();
            }
        }
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }
}
