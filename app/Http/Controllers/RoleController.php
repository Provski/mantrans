<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        // get current logged in user
        $user = Auth::user();

        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }
    
    public function edit($id)
    {
        // get current logged in user
        $user        = Auth::user();

        $role        = Role::where('id',$id)->first();
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));
    }

    public function store(Request $request)
    {
        // get current logged in user
        $user   = Auth::user();

        $request->validate([
            'name'  => ['required']
        ]);
        Role::create([
            'name'  => request('name'),
            'slug'  => Str::lower(request('name'))
        ]);
        // dd(request('name'));
        Session::flash('message-created', 'Role with name '.$request['name'].' was created');
        return back();
    }


    public function attachPermission(Role $role, $id)
    {
        // get current logged in user
        $user   = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $role = Role::where('id',$id)->first();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        $role->permissions()->attach(request('permission'));
        return back();
    }


    public function detachPermission(Role $role, $id)
    {
        // get current logged in user
        $user   = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $role = Role::where('id',$id)->first();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function update(Request $request, $id)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'name'  => ['required']
        ]);

        $role   = Role::where('id',$id)->first();

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('-');

        if($role->isDirty('name')){
            Session::flash('message-updated', 'Role was updated');
        } else {
            Session::flash('message', 'No Role was updated');
        }
        $role->save();
        return back();
    }


    public function Destroy($id)
    {
        // get current logged in user
        $user = Auth::user();

        $role = Role::where('id',$id)->first();
        
        Role::where('id',$id)->delete();
        // $quote->delete(['quote]);
        Session::flash('message', 'Role with name '.$role['name'].' was Deleted');
        return back();
    }
    
}
