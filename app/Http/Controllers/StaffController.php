<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function home() {
        return view('dashboard.staff.home');
    }

    public function profile() {
        return view('dashboard.staff.profile');
    }
}
