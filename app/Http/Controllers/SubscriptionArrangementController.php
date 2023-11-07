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
        $data['subscriptionArrangement'] = $activeSubscriptionArrangement;
        return view('dashboard.member.packages', $data);
    }

    public function subscriptionArrangements() {
        $data['subscriptionArrangements'] = SubscriptionArrangement::paginate(10);
        return view('dashboard.admin.subscription-arrangements', $data);
    }

    public function updateSubscriptionArrangement() {

    }

    public function viewSubscriptionArrangement() {

    }

    public function toggleArrangementStatus() {

    }

    public function toggleArrangementCountdown(Request $request) {
        $countdownStatus = $request->input('countdown_status');
        $subscriptionArrangement = SubscriptionArrangement::find($request->input('arrangement_id'));
        if(!$subscriptionArrangement) {
            return response()->json([
                'message' => 'We can\'t find that Subscription Arrangement'
            ]); 
        }

        $subscriptionArrangement->countdown = $countdownStatus;
        $subscriptionArrangement->save();

        return response()->json([
            'message' => 'Countdown Status for <strong>'.ucwords($subscriptionArrangement->arrangement_name).'</strong> successfully udpated.'
        ]); 
    }

    public function deleteSubscriptionArrangement() {

    }

}
