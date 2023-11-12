<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionArrangement;
use App\Models\SubscriptionTier;

class SubscriptionTierController extends Controller
{
    //
    public function index($arrangement_id) {
        $data['arrangement'] = SubscriptionArrangement::find($arrangement_id);
        $data['tiers'] = SubscriptionTier::where('subscription_arrangement_id', $arrangement_id)->orderBy('duration')->get();
        return view('dashboard.admin.subscription-arrangement-tiers', $data);
    }

    public function create(Request $request) {
        // Validate 
        $request->validate([
            "tier_name" => ['required', 'string', 'max:255'],
            "duration" => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric']
        ]);

        $arrangement = SubscriptionArrangement::find($request->arrangement_id);
        $tier = new SubscriptionTier([
            'tier_name' => $request->tier_name,
            'duration' => $request->duration,
            'price' => $request->price
        ]);

        $tier->subscriptionArrangement()->associate($arrangement);
        $tier->save();
        // redirect
        return redirect()->back()->with('success', 'Subscription Package: '.ucfirst($tier->tier_name).' Successfully Created.');
    }

    public function update(Request $request) {
        // Validate 
        $request->validate([
            "tier_name" => ['required', 'string', 'max:255'],
            "duration" => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric']
        ]);

        $tier = SubscriptionTier::find($request->tierId);
        $tier->tier_name = $request->tier_name;
        $tier->duration = $request->duration;
        $tier->price = $request->price;
        $tier->save();
        // redirect
        return redirect()->back()->with('success', 'Subscription Package: '.ucfirst($tier->tier_name).' Successfully updated.');
    }

    public function delete($package_id) {
        $package = SubscriptionTier::find($package_id);
        $package->delete();
        return response()->json([
            'message' => '<strong>'.ucfirst($package->tier_name).'</strong> successfully deleted.'
        ]); 
    }
}
