<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $notification = Notification::where('user_id', $user->id)->get();
        $result = NotificationResource::collection($notification);
        return response()->json([
            'status' => true,
            'data' => ['Notification' => $result],
        ]);
    }
}
