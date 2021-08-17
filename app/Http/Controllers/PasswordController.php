<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class PasswordController extends Controller
{
    public function edit(Request $request, $id)
    {
        // get current logged in user
        $user = Auth::user();

        if(auth()->user()->userHasRole('Admin')){
            $user   = User::where('id',$id)->first();
        } elseif ($request->user()->id == Auth::user()->id) {
            $user   = User::where('id', Auth::user()->id)->first();
        } else
        abort(403, 'You are not authorized');
        // dd($user);
        return view('admin.users.password', compact('user'));
    }


    public function update(Request $request)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'old_password'  => 'required',
            'password'      => 'required|string|min:8|confirmed',
        ]);

        $currentPassword    = auth()->user()->password;
        $old_password       = request('old_password');

        if (Hash::check($old_password, $currentPassword)) {
            auth()->user()->update([
                'password'  => bcrypt(request('password')),
            ]);
            Session::flash('message-updated', 'Password was updated');
            return back();
            
        } else {
            Session::flash('message', 'Password does not match with old password');
            return back();
            
        }
        // dd('request');
    }
}
