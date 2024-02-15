<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:question-read|question-create|question-update|question-delete|question-detail|question-restore', ['only' => ['index']]);
        $this->middleware('permission:question-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:question-update', ['only' => ['edit', 'update','store']]);
        $this->middleware('permission:question-delete', ['only' => ['destroy','hardDelete','multipleQuestionDelete']]);
        $this->middleware('permission:question-detail', ['only' => ['show']]);
        $this->middleware('permission:question-restore', ['only' => ['restore']]);
    }

    public function index()
    {
        return view('admin.question.index');
    }

    public function getQuestionList(Request $request)
    {
        if ($request->ajax()) {
            $question = DB::table('questions')
                ->orderBy('id', 'desc');

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $question->whereNotNull('questions.deleted_at');
                } else {
                    $question->whereNull('questions.deleted_at');
                }
            }
            $question = $question->select('questions.*');
            return Datatables::of($question)
                ->addColumn('action', function ($question) {
                    if (is_null($question->deleted_at)) {
                        $array = [
                            'id' => $question->id,
                            'actions' => [
                                'delete' => $question->id,
                                'detail-page' => route('admin.question.show',$question->id),
                                'delete_permission' => Auth::user()->can('news-delete'),
                                'detail_permission' => Auth::user()->can('news-detail'),
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $question->id,
                            'actions' => [
                                'hard-delete' => $question->id,
                                'restore' => $question->id,
                                'delete_permission' => Auth::user()->can('news-delete'),
                                'restore_permission' => Auth::user()->can('news-restore'),
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('check', function ($question) {
                    return  '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $question->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->rawColumns(['action', 'status', 'check'])
                ->make(true);
        }
    }

    public function destroy($id): JsonResponse
    {
        Question::where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }
    public function restore($id): JsonResponse
    {
        DB::table('questions')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => trans('admin_string.record_restore_successfully')
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('questions')->where('id', $id)->delete();
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }

    public function multipleQuestionDelete(Request $request): JsonResponse
    {
        $questions = DB::table('questions')->whereIn('id', $request->ids)->get();
        foreach ($questions as $question) {
            if (!is_null($question->deleted_at)) {
                DB::table('questions')->where('id', $question->id)->delete();
            } else {
                Question::where('id', $question->id)->delete();
            }
        }
        return response()->json([
            'message' => trans('admin_string.record_delete_successfully')
        ]);
    }
    public function show($id)
    {
        $question = DB::table('questions')->where('id', $id)->first();
        return view('admin.question.show',['question' => $question]);
    }
}
