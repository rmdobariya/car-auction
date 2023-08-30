<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $page = DB::table('pages')->where('status', 'active')->get();
        $result = PageResource::collection($page);
        return response()->json([
            'status' => true,
            'data' => ['page' => $result],
        ]);
    }

    public function show($id): JsonResponse
    {
        $page = DB::table('pages')
            ->where('status', 'active')
            ->where('id',$id)
            ->get();
        $result = PageResource::collection($page);
        return response()->json([
            'status' => true,
            'data' => ['page_detail' => $result],
        ]);
    }
}
