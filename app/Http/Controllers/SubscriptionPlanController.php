<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    public function index() {
        // In your controller method
        $activeSubscriptionPlan = SubscriptionPlan::where('status', 'active')->first();
        $data['tiers'] = $activeSubscriptionPlan->subscriptionTiers->where('status', 'active')->all();
        $data['subscriptionType'] = $activeSubscriptionPlan->subscription_name;
        return view('dashboard.member.packages', $data);
    }
}   
