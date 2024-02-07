<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function changePanelMode($mode): RedirectResponse
    {
        User::where('id', Auth::guard('admin')->user()->id)->update(['panel_mode' => $mode]);
        return redirect()->back();
    }

    public function changeLocale($locale): RedirectResponse
    {
        User::where('id', Auth::guard('admin')->user()->id)->update(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
}
