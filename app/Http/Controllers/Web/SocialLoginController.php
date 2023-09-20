<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
//    public function socialAccount()
//    {
//        $user = Auth::user();
//        return view('user.profile.socialAccount', ['user' => $user]);
//    }

    public function googleCallback(Request $request)
    {
        $userSocial = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $userSocial->getEmail())->first();
        if (\Auth::check()) {
            $userLogin = \Auth::user();
            $check = User::where('google_id', $userSocial->getId())
                ->where('google_id', '!=', $userLogin->google_id)
                ->first();

            if ($check) {
                return redirect()->route('socialAccount')->with(['error' => 'This Google Account is already registered with other user']);
            }
        }
        $name = explode(' ', $userSocial->getName());
        $first_name = $name[0] ?? null;
        $last_name = $name[1] ?? null;
        if ($user) {
            $user->full_name = $userSocial->getName();
            $user->name = $first_name;
            $user->last_name = $last_name;
            $user->user_type = 'buyer';
            $user->google_id = $userSocial->getId();
            $user->save();
        } else {
            $user = User::create([
                'full_name' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'name' => $first_name,
                'user_type' => 'buyer',
                'last_name' => $last_name,
                'google_id' => $userSocial->getId(),
            ]);
        }
        $intended_url = session('intended_url');
        Auth::login($user);
        if ($intended_url) {
            return redirect()->to(session('intended_url'));
        }
        return redirect()->intended('/');
    }

    public function facebookCallback(Request $request): \Illuminate\Http\RedirectResponse
    {
        dd(123);
        $userSocial = Socialite::driver('facebook')->stateless()->user();
        if (\Auth::check()) {
            $userLogin = \Auth::user();
            $check = User::where('facebook_id', $userSocial->getId())
                ->where('facebook_id', '!=', $userLogin->facebook_id)
                ->first();

            if ($check) {
                return redirect()->route('socialAccount')->with(['error' => 'This Facebook Account is already registered with other user']);
            }
        }

        $user = User::where(['email' => $userSocial->getEmail()])->first();
        $name = explode(' ', $userSocial->getName());
        $first_name = $name[0];
        $last_name = $name[1];
        if ($user) {
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->user_type = 'buyer';
            $user->facebook_id = $userSocial->getId();

            $user->save();
        } else {
            $user = User::create([
                'name' => $userSocial->getName(),
                'first_name' => $first_name,
                'last_name' => $last_name,
                'user_type' => 'buyer',
                'email' => $userSocial->getEmail(),
                'facebook_id' => $userSocial->getId(),
            ]);
        }
        $intended_url = session('intended_url');
        Auth::login($user);
        if ($intended_url) {
            return redirect()->to(session('intended_url'));
        }
        return redirect()->intended('/');
    }

    public function socialLogin($social): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver($social)->redirect();
    }
}
