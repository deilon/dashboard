<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionArrangement;

class SubscriptionArrangementController extends Controller
{
    public function index() {
        // In your controller method
        $activeSubscriptionArrangement = SubscriptionArrangement::where('status', 'active')->first();
        $data['tiers'] = $activeSubscriptionArrangement->subscriptionTiers->where('status', 'active')->all();
        $data['subscriptionArrangement'] = $activeSubscriptionArrangement->arrangement_name;
        return view('dashboard.member.packages', $data);
    }
}
