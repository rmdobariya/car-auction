<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $testimonial = DB::table('testimonials')
            ->leftJoin('testimonial_translations', 'testimonials.id', 'testimonial_translations.testimonial_id')
            ->where('testimonials.status', 'active')
            ->whereNull('testimonials.deleted_at')
            ->where('testimonial_translations.locale', App::getLocale())
            ->select('testimonials.*', 'testimonial_translations.title', 'testimonial_translations.role', 'testimonial_translations.description')
            ->get();
        $result = TestimonialResource::collection($testimonial);
        if (count($testimonial) > 0) {
            return response()->json([
                'status' => true,
                'data' => ['testimonial' => $result],
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => trans('app_string.data_not_found'),
                'data' => ['testimonial' => $result],
            ]);
        }
    }
}
