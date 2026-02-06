<?php

namespace App\Http\Controllers\Admin;

use App\Family;
use App\Member;
use App\Institution;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    	$family_count = Family::count();
    	$member_count = Member::count();
        return view('admin.dashboard',compact('family_count','member_count'));
    }
}
