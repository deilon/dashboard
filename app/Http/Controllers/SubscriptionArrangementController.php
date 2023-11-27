<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\SubscriptionArrangement;
use App\Models\SubscriptionTier;

class SubscriptionArrangementController extends Controller
{
    public function index() {
        // In your controller method
        $activeSubscriptionArrangement = SubscriptionArrangement::where('status', 'active')->first();
        
        if($activeSubscriptionArrangement != null) {
            $data['subscriptionArrangement'] = $activeSubscriptionArrangement;
            $data['tiers'] = SubscriptionTier::where('subscription_arrangement_id', $activeSubscriptionArrangement->id)->orderBy('duration')->get();
        } else {
            $data['subscriptionArrangement'] = null;
        }

        
        return view('member.packages', $data);
    }

    /**
     * 
     * List of subscription arrangements
     */
    public function subscriptionArrangements() {
        $data['subscriptionArrangements'] = SubscriptionArrangement::paginate(10);
        return view('management.subscription-arrangements', $data);
    }

    public function addArrangement(Request $request) {
        $validator = Validator::make($request->all(), [
            'arrangement_name' => ['required', 'string', 'max:255'],
            'start_date' => 'required_with:end_date|nullable|date|after_or_equal:today|before:end_date',
            'end_date' => 'required_with:start_date|nullable|date|after:today',
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
        $subscriptionArrangement->default = "no";
        $subscriptionArrangement->promo = $request->has('promo') ? 'yes' : 'no';
        $subscriptionArrangement->save();
    
        // redirect with success message
        return redirect()->back()->with('success', 'Subscription Arrangement has been saved.');
    }

    public function updateArrangement(Request $request) {
        $validator = Validator::make($request->all(), [
            'arrangement_name' => ['required', 'string', 'max:255'],
            'start_date' => 'required_with:end_date|nullable|date|before:end_date',
            'end_date' => 'required_with:start_date|nullable|date|after:today', 
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Something went wrong. Please check the form and try again.');
        }
    
        $subscriptionArrangement = SubscriptionArrangement::find($request->arrangement_id);
        $subscriptionArrangement->arrangement_name = $request->arrangement_name;
        $subscriptionArrangement->start_date = $request->start_date;
        $subscriptionArrangement->end_date = $request->end_date;
        $subscriptionArrangement->promo = $request->has('promo') ? 'yes' : 'no';
        $subscriptionArrangement->save();
    
        // redirect with success message
        return redirect()->back()->with('success', 'Subscription Arrangement has been saved.');
    }

    public function viewSubscriptionArrangement() {

    }

    public function toggleArrangementStatus(Request $request)
    {  
        $status = $request->input('status');
        $arrangement = SubscriptionArrangement::find($request->input('arrangement_id'));
        if(!$arrangement) {
            return response()->json([
                'message' => 'We can\'t find that arrangement'
            ]); 
        }

        $arrangement->status = $status;
        $arrangement->save();

        return response()->json([
            'message' => 'Status for <strong>'.ucfirst($arrangement->arrangement_name).'</strong> successfully udpated.'
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

    public function deleteSubscriptionArrangement($arrangement_id) {
        $arrangement = SubscriptionArrangement::find($arrangement_id);
        $arrangement->delete();
        return response()->json([
            'message' => '<strong>'.ucfirst($arrangement->arrangement_name).'</strong> successfully deleted.'
        ]); 
    }

}
