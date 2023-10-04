<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:question-read|question-create|question-update|question-delete', ['only' => ['index']]);
        $this->middleware('permission:question-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:question-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:question-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.question.index');
    }

    public function getQuestionList(Request $request)
    {
        if ($request->ajax()) {
            $question = DB::table('questions')
                ->leftJoin('users', 'questions.user_id', 'users.id')
                ->orderBy('id', 'desc');

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $question->whereNotNull('questions.deleted_at');
                } else {
                    $question->whereNull('questions.deleted_at');
                }
            }
            $question = $question->select('questions.*', 'users.full_name');
            return Datatables::of($question)
                ->addColumn('action', function ($question) {
                    if (is_null($question->deleted_at)) {
                        $array = [
                            'id' => $question->id,
                            'actions' => [
                                'delete' => $question->id,
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $question->id,
                            'actions' => [
                                'hard-delete' => $question->id,
                                'restore' => $question->id,
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
                ->addColumn('user', function ($question) {
                    return $question->full_name;
                })
                ->rawColumns(['action', 'status', 'check'])
                ->make(true);
        }
    }

    public function destroy($id): JsonResponse
    {
        Question::where('id', $id)->delete();
        return response()->json([
            'message' => 'Question Delete Successfully'
        ]);
    }
    public function restore($id): JsonResponse
    {
        DB::table('questions')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Question Restore Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('questions')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Question Delete Successfully'
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
            'message' => 'Question Delete Successfully'
        ]);
    }
}
