<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\QuestionStoreRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(QuestionStoreRequest $request): JsonResponse
    {
        $question = new Question();
        $question->first_name = $request->first_name;
        $question->last_name = $request->last_name;
        $question->name = $request->first_name . ' ' . $request->last_name;
        $question->email = $request->email;
        $question->contact_number = $request->mobile_no;
        $question->question = $request->question;
        $question->save();
        return response()->json([
            'status' => true,
            'message' => trans('web_string.question_save_successfully')
        ]);
    }
}
