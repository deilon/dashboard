<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionTier;
use App\Models\SubscriptionArrangement;
use App\Models\CreditCard;
use App\Models\Gcash;
use App\Models\ManualPayment;


class MemberController extends Controller
{
    public function home() {
        return view('member.home');
    }

    public function packages() {
        return view('member.packages');
    }

    /**
     * Show to unsubscribed users
     */
    public function unavailableFitnessProgress() {
        return view('member.default-manage-fitness-view');
    }

    /**
     * My progress
     */
    public function myProgress() {
        return view('member.my-progress');
    }

    /**
     * View/Edit My Weekly progress
     */
    public function myWeeklyProgress() {
        return view('member.my-weekly-progress-view');
    }

    public function membershipDetails() {
        $subscription = Subscription::where('user_id', Auth::user()->id)->first();
        $data['subscription'] = $subscription;
        if($subscription) {
            $current_date = date('Y-m-d');
            $start_timestamp = strtotime($subscription->start_date);
            $end_timestamp = strtotime($subscription->end_date);
            $current_timestamp = strtotime($current_date);
            $data['total_days'] = ($end_timestamp - $start_timestamp) / (60 * 60 * 24);
            $data['days_elapsed'] = ($current_timestamp - $start_timestamp) / (60 * 60 * 24);
            $data['percentage_completed'] = ($data['days_elapsed'] / $data['total_days']) * 100;
    
            $data['start_date'] = Carbon::parse($subscription->start_date);
            $data['end_date']= Carbon::parse($subscription->end_date);
    
            
            $data['tier'] = SubscriptionTier::where('id', $subscription->subscription_tier_id)->first();
            $data['user'] = Auth::user();

            $data['assigned_staff'] = User::find($subscription->staff_assigned_id);

            if($subscription->payment_option == 'credit card') {
                $data['creditCard'] = CreditCard::where('subscription_id', $subscription->id)->first();
            } else if ($subscription->payment_option == 'gcash') {
                $data['gCash'] = Gcash::where('subscription_id', $subscription->id)->first();
            } else if ($subscription->payment_option == 'manual payment') {
                $data['manualPayment'] = ManualPayment::where('subscription_id', $subscription->id)->first();
            }


            return view('member.membership-details', $data);
        }

        return view('member.membership-details', $data);
    }

}
