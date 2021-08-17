<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;



class PermissionController extends Controller
{
    public function index()
    {
        // get current logged in user
        $user = Auth::user();

        // $users = User::get();
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }


    public function store(Request $request)
    {
        // get current logged in user
        $user   = Auth::user();

        $request->validate([
            'name'  => ['required']
        ]);
        $permissions = Permission::create([
            'name'  => Str::ucfirst(request('name')),
            'slug'  => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        Session::flash('message-created', 'Permission with name '.$request['name'].' was created');
        return back();
    }


    public function edit($id)
    {
        // get current logged in user
        $user           = Auth::user();

        $permission    = Permission::where('id',$id)->first();
        
        return view('admin.permissions.edit', compact('permission'));
    }


    public function update(Request $request, $id)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'name'  => ['required']
        ]);
        $permission   = Permission::where('id',$id)->first();

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(request('name'))->slug('-');

        if($permission->isDirty('name')){
            Session::flash('message-updated', 'permission was updated');
        } else {
            Session::flash('message', 'No permission was updated');
        }
            $permission->save();
            return back();
    }


    public function Destroy($id)
    {
        // get current logged in user
        $user       = Auth::user();

        $permission = Permission::where('id',$id)->first();
        
        Permission::where('id',$id)->delete();
        // $quote->delete(['quote]);
        Session::flash('message', 'Permission with name '.$permission['name'].' was Deleted');
        return back();
    }


}
