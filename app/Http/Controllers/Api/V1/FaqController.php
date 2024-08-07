<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $faq = Faq::where('status', 'active')->get();
        $result = FaqResource::collection($faq);
        if (count($faq) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['faq' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['faq' => $result],
            ]);
        }

    }
}
