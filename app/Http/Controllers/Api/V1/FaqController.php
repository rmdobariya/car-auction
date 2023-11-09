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
        if (count($faq) > 0) {
            $result = FaqResource::collection($faq);
            return response()->json([
                'status' => true,
                'data' => ['faq' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not Found',
                'data' => [],
            ]);
        }

    }
}
