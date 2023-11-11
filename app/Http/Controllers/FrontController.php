<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnnouncementsPromotion;

class FrontController extends Controller
{
    public function index() {
        $data['aps'] = AnnouncementsPromotion::orderBy('created_at', 'desc')->take(2)->get();
        return view('home', $data);
    }

    public function announcementsPromotions() {
        $data['aps'] = AnnouncementsPromotion::orderBy('created_at', 'desc')->get();
        return view('announcements', $data);
    }
}
