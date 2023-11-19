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

class AdminController extends Controller
{
    public function home() {
        return view('admin.home');
    }

    public function adminRecords($role) {
        $data['users'] = User::where('role', $role)->paginate(10);
        $data['role'] = $role;
        return view('admin.admin-records', $data);
    }

    public function usersRecords($role) {
        $data['users'] = User::where('role', $role)->paginate(10);
        $data['role'] = $role;
        return view('admin.users-records', $data);
    }

    public function staffRecords($role) {
        $data['users'] = User::where('role', $role)->paginate(10);
        $data['role'] = $role;
        return view('admin.staff-records', $data);
    }

    public function subscribers() {
        $data['subscriptions'] = Subscription::paginate(10);
        $data['staffs'] = User::where('role', 'staff')->where('status', 'active')->get();
        return view('admin.subscribers', $data);
    }

    public function updateSubscriptionTrainer(Request $request) {
        $staffId = $request->input('staff');
        $subscriptionId = $request->input('subscription_id');
        $subscriberId = $request->input('subscriber_id');

        $staff = User::find($staffId);
        $subscription = Subscription::find($subscriptionId);
        $subscriber = User::find($subscriberId);
        if(!$subscription) {
            return response()->json([
                'message' => 'We can\'t find the subscription'
            ]); 
        }
        
        $staffImageUrl = $staff->photo ? asset('storage/assets/img/avatars/'.$staff->photo) : asset('storage/assets/img/avatars/default.jpg');
        $staffName = ucwords($staff->firstname.' '.$staff->lastname);
        $subscription->staff_assigned_id = $staffId;
        $subscription->save();

        return response()->json([
            'message' => 'Assigned Staff/Trainer for <strong>'.ucwords($subscriber->firstname.' '.$subscriber->lastname).'</strong> successfully udpated.',
            'staffImageUrl' => $staffImageUrl,
            'staffName' => $staffName
        ]); 
    }

    public function removeTrainer(Request $request) {
        $subscriptionId = $request->input('subscription_id');
        $subscriberId = $request->input('subscriber_id');

        $subscription = Subscription::find($subscriptionId);
        $subscriber = User::find($subscriberId);
        if(!$subscription) {
            return response()->json([
                'message' => 'We can\'t find the subscription'
            ]); 
        }
        
        $subscription->staff_assigned_id = null;
        $subscription->save();

        return response()->json([
            'message' => 'Assigned Staff/Trainer for <strong>'.ucwords($subscriber->firstname.' '.$subscriber->lastname).'</strong> successfully deleted.'
        ]); 
    }

    public function updateSubscriptionStatus(Request $request) {
        $status = $request->input('status');
        $subscriptionId = $request->input('subscription');
        $subscription = Subscription::find($subscriptionId);
        $subscriber = User::find($request->subscriber_id);
        if(!$subscription) {
            return response()->json([
                'message' => 'We can\'t find that subscription'
            ]); 
        }

        $subscription->status = $status;
        $subscription->save();

        return response()->json([
            'message' => 'Subscription status for <strong>'.ucwords($subscriber->firstname.' '.$subscriber->lastname).'</strong> successfully udpated.'
        ]);         
    }

    public function viewSubscription($subscriber_id) {
        $subscription = Subscription::where('user_id', $subscriber_id)->first();
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


            return view('admin.view-subscription', $data);
        }

        return view('member.view-subscription', $data);
    }

    public function updateStatus(Request $request)
    {  
        $status = $request->input('status');
        $user = User::find($request->input('user_id'));
        if(!$user) {
            return response()->json([
                'message' => 'We can\'t find that user'
            ]); 
        }

        $user->status = $status;
        $user->save();

        return response()->json([
            'message' => 'Status for <strong>'.$user->firstname.' '.$user->lastname.'</strong> successfully udpated.'
        ]); 
    }

    public function viewProfile($user_id) {
        $data['user'] = User::find($user_id);
        
        // Check if user is subscribed
        $subscription = Subscription::where('user_id', $user_id)
                        ->where(function ($query) {
                            $query->where('status', 'active')
                                ->orWhere('status', 'pending');
                        })
                        ->first();
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
    
            return view('admin.view-profile', $data);
        }

        return view('admin.view-profile', $data);
    }

    public function deleteUser($user_id) {
        $user = User::find($user_id);
        $user->delete();
        return response()->json([
            'message' => '<strong>'.$user->firstname.' '.$user->lastname.'</strong> successfully deleted.'
        ]); 
    }
}
