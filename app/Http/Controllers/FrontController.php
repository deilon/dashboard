<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnnouncementsPromotion;
use App\Models\SubscriptionArrangement;

class FrontController extends Controller
{
    public function index() {
        $data['aps'] = AnnouncementsPromotion::orderBy('created_at', 'desc')->take(2)->get();
        $data['activeArrangement'] = SubscriptionArrangement::where('status', 'active')->first();
        return view('home', $data);
    }

    public function announcementsPromotions() {
        $data['aps'] = AnnouncementsPromotion::orderBy('created_at', 'desc')->get();
        return view('announcements', $data);
    }
}
