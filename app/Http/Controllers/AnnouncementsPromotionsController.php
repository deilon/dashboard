<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementsPromotionsController extends Controller
{
    public function index() {
        return view('dashboard.admin.announcements-promotions');
    }
}
