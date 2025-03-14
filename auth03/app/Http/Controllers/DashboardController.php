<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function student(){
        return view('student');
    }
    public function teacher(){
        return view('teacher');
    }
    public function dashboard(){
        return view('dashboard');
    }
}
