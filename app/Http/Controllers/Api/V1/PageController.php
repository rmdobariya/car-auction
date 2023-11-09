<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $page = DB::table('pages')
            ->leftJoin('page_translations', 'pages.id', 'page_translations.page_id')
            ->where('page_translations.locale', App::getLocale())
            ->where('pages.status', 'active')
            ->select('pages.*', 'page_translations.name', 'page_translations.description')
            ->get();
        $result = PageResource::collection($page);
        if (count($page) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['page' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Not Found',
                'data' => ['page' => $result],
            ]);
        }

    }

    public function show($slug): JsonResponse
    {
        $page = DB::table('pages')
            ->leftJoin('page_translations', 'pages.id', 'page_translations.page_id')
            ->where('page_translations.locale', App::getLocale())
            ->where('pages.status', 'active')
            ->where('pages.slug', $slug)
            ->select('pages.*', 'page_translations.name', 'page_translations.description')
            ->get();
        $result = PageResource::collection($page);
        if (!is_null($page)) {
            return response()->json([
                'status' => true,
                'data' => ['page_detail' => $result],
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Data Not Found',
            'data' => ['page_detail' => $result],
        ]);
    }
}
