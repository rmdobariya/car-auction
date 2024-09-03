<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!is_null($user)) {
            if (!is_null($user->deleted_at)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'warning',
                        'message' => trans('web_string.your_account_is_deleted_by_admin'),
                        'reload' => true // Add a reload instruction
                    ]);
                } else {
                    session()->flash('warning', trans('web_string.your_account_is_deleted_by_admin'));
//                    return redirect('/');
                }
            } elseif ($user->status === 'inActive') {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'warning',
                        'message' => trans('web_string.your_account_is_inactive_by_admin'),
                        'reload' => true // Add a reload instruction
                    ]);
                }
                session()->flash('warning', trans('web_string.your_account_is_inactive_by_admin'));
//                return back();
            }
        }

        return $next($request);
    }
}
