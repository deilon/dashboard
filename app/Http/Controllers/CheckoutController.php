<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionTier;

class CheckoutController extends Controller
{

    public function checkoutPage($subscriptionType, $tier_id) {
        $data['user'] = Auth::user();
        $data['tier'] = SubscriptionTier::find($tier_id);
        $data['arrangement_name'] = $subscriptionType;
        $data['tier_id'] = $tier_id;
        $data['tier_name'] = SubscriptionTier::find($tier_id)->tier_name;
       return view('dashboard.member.checkout', $data);
   }
}
