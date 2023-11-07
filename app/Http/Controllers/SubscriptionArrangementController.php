<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
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

    public function saveArrangement(Request $request) {
        $validator = Validator::make($request->all(), [
            'arrangement_name' => ['required', 'string', 'max:255'],
            'start_date' => 'required_with:end_date|nullable|date|after_or_equal:'. Carbon::now()->format('m-d-Y'),
            'end_date' => 'required_with:start_date|nullable|date|after:start_date',
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Something went wrong. Please check the form and try again.');
        }
    
        $subscriptionArrangement = new SubscriptionArrangement();
        $subscriptionArrangement->arrangement_name = $request->arrangement_name;
        $subscriptionArrangement->start_date = $request->start_date;
        $subscriptionArrangement->end_date = $request->end_date;
        $subscriptionArrangement->status = "disabled";
        $subscriptionArrangement->countdown = "disabled";
        $subscriptionArrangement->save();
    
        // redirect with success message
        return redirect()->back()->with('success', 'Subscription Arrangement has been saved.');
    }

    public function viewSubscriptionArrangement() {

    }

    public function toggleArrangementStatus(Request $request) {
        $status = $request->input('status');
        $subscriptionArrangement = SubscriptionArrangement::find($request->input('arrangement_id'));
        if(!$subscriptionArrangement) {
            return response()->json([
                'message' => 'We can\'t find that Subscription Arrangement'
            ]); 
        }

        $subscriptionArrangement->status = $status;
        $subscriptionArrangement->save();

        return response()->json([
            'message' => 'Status for <strong>'.ucwords($subscriptionArrangement->arrangement_name).'</strong> successfully udpated.'
        ]); 
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
