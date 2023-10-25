<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageStringResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class LanguageStringController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $language_string = DB::table('language_strings')
            ->leftJoin('language_string_translations', 'language_strings.id', 'language_string_translations.language_string_id')
            ->where('language_string_translations.locale', App::getLocale())
            ->select('language_strings.*', 'language_string_translations.name as name')
            ->get();
        $result = LanguageStringResource::collection($language_string);
        return response()->json([
            'status' => true,
            'data' => ['Language String' => $result],
        ]);
    }
}
