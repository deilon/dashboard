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

    public function deleteUser($user_id) {
        $user = User::find($user_id);
        $user->delete();
        return response()->json([
            'message' => '<strong>'.$user->firstname.' '.$user->lastname.'</strong> successfully deleted.'
        ]); 
    }
}
