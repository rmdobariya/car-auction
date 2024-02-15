<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $blog = DB::table('blogs')
            ->leftJoin('blog_translations', 'blogs.id', 'blog_translations.blog_id')
            ->where('blogs.status', 'active')
            ->whereNull('blogs.deleted_at')
            ->where('blog_translations.locale', App::getLocale())
            ->select('blogs.*', 'blog_translations.title', 'blog_translations.description')
            ->get();
        $result = BlogResource::collection($blog);
        if (count($blog) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['blog' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['blog' => $result],
            ]);
        }

    }
}
