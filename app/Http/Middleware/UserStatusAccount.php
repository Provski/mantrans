<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserStatusAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     if ($request->input('token') !== 'my-secret-token') {
    //         return redirect('home');
    //     return $next($request);
    // }


    public function handle(Request $request, Closure $next)
    {
        $user = User::where('status',$request->status)->first();
        if (auth()->user()->status == 1) {
            return $next($request);
        } Auth::logout();
        return redirect()->route('auth.login');
    }
}
