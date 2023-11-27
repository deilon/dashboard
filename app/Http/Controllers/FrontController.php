<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnnouncementsPromotion;
use App\Models\SubscriptionArrangement;

class FrontController extends Controller
{
    public function index() {
        $aps = AnnouncementsPromotion::orderBy('created_at', 'desc')->take(2)->get();
        if($aps != null) {
            $data['aps'] = AnnouncementsPromotion::orderBy('created_at', 'desc')->take(2)->get();
        } else {
            $data['aps'] = null;
        }
        
        
        $activeArrangement = SubscriptionArrangement::where('status', 'active')->first();
        if($activeArrangement) {
            $data['activeArrangement'] = $activeArrangement;
        } else {
            $data['activeArrangement'] = null;
        }
        
        return view('home', $data);
    }

    public function announcementsPromotions() {
        $aps = AnnouncementsPromotion::orderBy('created_at', 'desc')->take(2)->get();
        if($aps != null) {
            $data['aps'] = AnnouncementsPromotion::orderBy('created_at', 'desc')->take(2)->get();
        } else {
            $data['aps'] = null;
        }
        return view('announcements', $data);
    }
}
