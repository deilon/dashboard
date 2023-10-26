<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use App\Models\Subscription;
use App\Models\SubscriptionTier;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request) {
        // Validate and update the user...
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'middlename' => ['sometimes', 'nullable', 'string', 'max:255'],
            'phone_number' => 'required|regex:/[0-9]{9}/',
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
        ]);

        // Store update
        $user = Auth::user();
        $user->firstname = strtolower($request->firstname);
        $user->lastname = strtolower($request->lastname);
        $user->middlename = strtolower($request->middlename);
        $user->phone_number = $request->phone_number;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->email = strtolower($request->email);
        $user->save();

        $tier = SubscriptionTier::find($request->tierId);
        if($tier->duration == "2 Months") {
            $this->subscribeTwoMonths($user, $tier);
        } else if($tier->duration == "3 Months") {
            $this->subscribeThreeMonths($user, $tier);
        } else if($tier->duration == "6 Months") {
            $this->subscribeSixMonths($user, $tier);
        } else {
            $this->subscribeTwelveMonths($user, $tier);
        }
            

        // redirect
        return redirect()->back()->with('success', 'You have successfully subscribed.');
    }

    public function subscribeTwoMonths($user, $tier) {
        $subscription = new Subscription;
        $subscription->user_id = $user->id;
        $subscription->subscription_tier_id = $tier->id;
        $subscription->amount_paid = $tier->price;
        $subscription->status = 'active';
        $subscription->start_date = Carbon::now();
        $subscription->end_date = Carbon::now()->addMonths(2);
        $subscription->save();
    }

    public function subscribeThreeMonths($user, $tier) {
        $subscription = new Subscription;
        $subscription->user_id = $user->id;
        $subscription->subscription_tier_id = $tier->id;
        $subscription->amount_paid = $tier->price;
        $subscription->status = 'active';
        $subscription->start_date = Carbon::now();
        $subscription->end_date = Carbon::now()->addMonths(3);
        $subscription->save();
    }

    public function subscribeSixMonths($user, $tier) {
        $subscription = new Subscription;
        $subscription->user_id = $user->id;
        $subscription->subscription_tier_id = $tier->id;
        $subscription->amount_paid = $tier->price;
        $subscription->status = 'active';
        $subscription->start_date = Carbon::now();
        $subscription->end_date = Carbon::now()->addMonths(6);
        $subscription->save();
    }

    public function subscribeTwelveMonths($user, $tier) {
        $subscription = new Subscription;
        $subscription->user_id = $user->id;
        $subscription->subscription_tier_id = $tier->id;
        $subscription->amount_paid = $tier->price;
        $subscription->status = 'active';
        $subscription->start_date = Carbon::now();
        $subscription->end_date = Carbon::now()->addYear();
        $subscription->save();
    }

}
