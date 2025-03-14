<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function loginAdmin(){
        return view('admin.login');
    }
    public function processLoginAdmin(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $credentials=$request->only('email','password');
        if(Auth::guard('admin')->attempt($credentials)){
           return redirect()->route('admin.dashboard');
        }else{
            return redirect()->back()->with('errors','invalid');
        }
    }
    public function logoutAdmin(){
        Auth::guard('admin')->logout();
        return redirect()->route('login.admin');
    }
}
