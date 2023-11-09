<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $blog = Blog::where('status', 'active')->get();
        $result = BlogResource::collection($blog);
        if (count($blog) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['blog' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not Found',
                'data' => ['blog' => $result],
            ]);
        }

    }
}
