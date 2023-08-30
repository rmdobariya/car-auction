<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $seller_count = DB::table('users')->where('user_type', 'seller')->whereNull('deleted_at')->count();
        $buyer_count = DB::table('users')->where('user_type', 'buyer')->whereNull('deleted_at')->count();
        $user_count = DB::table('users')->where('user_type', 'user')->whereNull('deleted_at')->count();
        $category_count = DB::table('categories')->where('status', 'active')->whereNull('deleted_at')->count();
        $vehicle_count = DB::table('vehicles')->where('status', 'active')->whereNull('deleted_at')->count();
        return view('admin.dashboard.dashboard', [
            'seller_count' => $seller_count,
            'buyer_count' => $buyer_count,
            'user_count' => $user_count,
            'category_count' => $category_count,
            'vehicle_count' => $vehicle_count,
        ]);
    }
}
