<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function viewMemberDashboard() {
        return view('member.dashboard');
    }
}
