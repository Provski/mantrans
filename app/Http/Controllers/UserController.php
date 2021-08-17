<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        // get current logged in user
        $user = Auth::user();

        $users = User::orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }


    public function show($id)
    {
        // get current logged in user
        $user = Auth::user();

        if(auth()->user()->userHasRole('Admin')){
            $user   = User::where('id',$id)->first();
        }
        return view('admin.users.profile', compact('user'));
    }


    public function update(Request $request, $id)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:50',
            'email'     => 'required|email|max:100',
            'avatar'    => 'required|file:jpg,png|max:1000'
        ]);

        $user  = User::where('id',$id)->first();
        
        if(\File::exists('storage/images/avatar/'. $user->avatar)){
            \File::delete('storage/images/avatar/'.$user->avatar);
        }

        // menyimpan data file yang diupload ke variabel $file
        $file       = $request->file('avatar');
        $fileName   = time(). "." .$file->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $destinationPath    = 'storage/images/avatar';
        $file->move($destinationPath,$fileName);

        $user   = DB::table('users')
                    ->where('id',$id)
                    ->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'avatar'    => $fileName
            ]);
            Session::flash('message-updated', 'Profile was updated');
            return back();
    }


    public function changeStatus(Request $request)
    {
        // get current logged in user
        $user = Auth::user();

        $user   = User::find($request->user_id);
        $user->status=$request->status;
        
        if($user->save()){
            return response()->json(['success'=>'Status change successfully.']);
        } else {
            return response()->json(['danger'=>'Status not change']);
        }
    }


    public function userList()
    {
        // get current logged in user
        $user = Auth::user();

        $users = User::get();
        $roles = Role::get();
        // dd($roles);
        return view('admin.users.userlist', compact('users','roles'));
    }


    public function modify($id)
    {
        // get current logged in user
        $user   = Auth::user();
        
        // if (auth()->user()->userHasRole('Admin')) {
            // $user   = User::where('id',$id)->first();
            // $roles  = Role::get();
            // } elseif (auth()->user()->userHasRole('Manager')) {
                // $user = User::where('id', $id)->first();
                // $roles  = Role::get();
                    // } else {
                        // abort(403, 'You are not authorized');
                    // }
        $user   = User::where('id',$id)->first();
        $roles  = Role::get();
        return view('admin.users.edit', compact('user','roles'));
    }


    public function attach(User $user, $id)
    {
        // get current logged in user
        $user   = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $user   = User::where('id',$id)->first();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        $user = User::where('id',$id)->first();
        
        $user->roles()->attach(request('role'));
        return back();
    }


    public function detach(User $user, $id)
    {
        // get current logged in user
        $user   = Auth::user($id);

        if (auth()->user()->userHasRole('Admin')) {
            $user   = User::where('id',$id)->first();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        $user->roles()->detach(request('role'));
        return back();
    }


    public function userDestroy($id)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $user   = User::where('id',$id)->first();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        $user = User::where('id',$id)->first();
        
        User::where('id',$id)->delete();
        Session::flash('message', 'User with name '.$user['name'].' was Deleted');
        return back();
    }

}
