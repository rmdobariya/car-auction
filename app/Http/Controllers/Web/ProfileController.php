<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if ($user) {
            return view('website.profile.user_profile', ['user' => $user]);

        }
        abort(404);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->fname;
        $user->last_name = $request->lname;
        $user->full_name = $request->fname . ' ' . $request->lname;
        $user->save();

        return response()->json([
            'message' => 'Profile Update Successfully'
        ]);
    }

    public function changeImage(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($request->hasfile('image')) {
            $image = ImageUploadHelper::imageUpload($request->file('image'), 'profile');
            $user->image = $image;
        }
        $user->save();

        return response()->json([
            'message' => 'Profile Change Image Successfully'
        ]);
    }
}
