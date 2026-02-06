<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    	$user_name = Auth::user()->name;
        return view('student.dashboard', compact('user_name'));
    }
}
