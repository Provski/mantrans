<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //login Success
            return redirect()->route('blog.admin');
        }
            return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required'
        ];

        $messages = [
            'email.required'    => 'email wajib diisi',
            'email.email'       => 'email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.string'   => 'Password harus berupa string'
        ];

        $validator  = Validator::make($request->all(), $rules, $messages); 
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        ];

        Auth::attempt($data);

        if(Auth::check()){// true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            Session::flash('message-created', 'Congratulations You are login');
            return redirect()->route('blog.admin');
        } else {//false 
            //Login Fail
            return redirect()->route('auth.login');
        }

    }

    public function showFormRegister()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $rules  = [
            'name'      => 'required|min:3|max:35',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed'
        ];

        $messages = [
            'name.required'     => 'Nama lengkap wajib diisi',
            'name.min'          => 'Nama lengkap minimal 3 karakter',
            'name.max'          => 'Nama lengkap maksimal 35 karakter',
            'email.required'    => 'Email wajib diisi',
            'email.email'       => 'Email tidak valid',
            'email.unique'      => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.confirmed'=> 'Password konfirmasi harus sama dengan sebelumnya'    
        ];

        $validator  = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

        $user  = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_veirified_at = \Carbon\Carbon::now();
        $simpan = $user->save();

        if($simpan){
            Session::flash('message-created', 'Registration Succeed! Check Your email later');
            return redirect()->route('auth.login');
        } else {
            Session::flash('message', ['' => 'Registration failed! Try again later']);
            return redirect()->route('auth.register');
        }

    }


    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('auth.login');
    }
  
    
}
