<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ReviewStoreRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(ReviewStoreRequest $request)
    {
        if ($request->edit_value == 0){
            $review = new Review();
            $review->user_id = $request->user_id;
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->save();
            return response()->json([
                'success' => true,
                'message' => trans('web_string.review_add_for_zodha_platform')
            ]);
        }
        $review = Review::find($request->edit_value);
        $review->user_id = $request->user_id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();
        return response()->json([
            'success' => true,
            'message' => trans('web_string.review_update_for_zodha_platform')
        ]);
    }
}
