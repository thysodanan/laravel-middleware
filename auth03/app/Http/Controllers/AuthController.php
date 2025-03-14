<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }
    public function register(){
        return view('register');
    }
    public function processLogin(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $credentials=$request->only('email','password');
        if(Auth::guard('user')->attempt($credentials)){
            $user=Auth::guard('user')->user()->role;
            if($user=='teacher'){
                return redirect()->route('teacher');
            }elseif($user=='student'){
                return redirect()->route('student');
            }
        }else{
            return redirect()->back()->with('errors','invalid');
        }
    }
    public function processRegister(Request $request){
       $validator=Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required|email',
        'password'=>'required',
        'confirm_password'=>'required|same:password'
       ]);
       if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput($request->all());
       }
       if($validator->passes()){
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('login');
       }
    }
}
