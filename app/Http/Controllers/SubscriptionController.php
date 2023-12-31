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
use App\Models\SubscriptionArrangement;
use App\Models\Gcash;
use App\Models\CreditCard;
use App\Models\ManualPayment;
use App\Models\Sale;
use App\Models\User;
use App\Mail\PaymentReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class SubscriptionController extends Controller
{
   
    public function subscribe(Request $request) {


        // User details Validation / Validation Rules
        $userDetailsValidationRules = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'middlename' => ['sometimes', 'nullable', 'string', 'max:255'],
            'phone_number' => 'required|regex:/[0-9]{9}/',
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
        ];

        // Payment Option Validation / Validation Rules
        $paymentOptionValidationRules = [];
        if($request->paymentOption == 'creditCard') {
            $paymentOptionValidationRules = [                
                'cardNumber' => 'required|numeric|digits_between:13,19',
                'month' => ['required', 'digits:2', 'regex:/^(0[1-9]|1[0-2])$/'], // Validate month is between 01 and 12
                'year' => ['required', 'digits:2', 'after_or_equal:' . date('y')], // Validate year is in the future or the current year]
                'cvv_cvc' => 'required|numeric|digits_between:3,4',
                'cardHolderName' => 'required|string|max:255', // Adjust the max length as needed
            ];
        } else if($request->paymentOption == 'gcash') {
            $paymentOptionValidationRules = [
                'mobile_number' => ['required', 'regex:/^(09|\+639)\d{9}$/'], // Validates a Philippine mobile number format
                'amount' => ['required', 'numeric'], // Validates that 'amount' is a numeric value
                'gCashFile' => ['required', 'image', 'max:2048'] // Validates file format (PDF, JPG/JPEG, PNG)
            ];
        } else if($request->paymentOption == 'manualPayment') {
            $paymentOptionValidationRules = [
                'fullName' => ['required', 'string', 'max:255'],
                'manual_payment_amount' => ['required', 'numeric'], // Validates that 'amount' is a numeric value
            ]; 
        }
        

        // Merge and validate the two validation rules
        $validationRules = array_merge($userDetailsValidationRules, $paymentOptionValidationRules);
        $validator = validator($request->all(), $validationRules);

        // Check the validity of all fields and Update user, Store subscription, Store Credit cards or gcashes
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Save user details
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

            // Create subscription
            $tier = SubscriptionTier::find($request->tierId);
            $subscriptionArrangement = SubscriptionArrangement::find($request->subscriptionArrangementId);
            $subscription = new Subscription;
            $subscription->user_id = $user->id;
            $subscription->subscription_arrangement_id = $subscriptionArrangement->id;
            $subscription->subscription_tier_id = $tier->id;
            $subscription->amount_paid = $tier->price;
            $subscription->status = 'pending';
            $subscription->start_date = Carbon::now();
            
            
            if($tier->duration == '2 Months') {
                $subscription->end_date = Carbon::now()->addMonths(2);
            } else if ($tier->duration == '3 Months') {
                $subscription->end_date = Carbon::now()->addMonths(3);
            } else if ($tier->duration == '6 Months') {
                $subscription->end_date = Carbon::now()->addMonths(6);
            } else {
                $subscription->end_date = Carbon::now()->addYear();
            }
            $subscription->payment_option = $request->paymentOption;
            $subscription->save();

            // Create Payment option Credit Card / Gcash
            if($request->paymentOption == 'creditCard') {
                $creditCard = new CreditCard([
                    'credit_card_number' => $request->cardNumber,
                    'valid_thru_month' => $request->month,
                    'valid_thru_year' => $request->year,
                    'cvv_cvc' => $request->cvv_cvc,
                    'cardholder_name' => $request->cardHolderName,
                ]);
                $creditCard->user()->associate($user);
                $subscription->creditCard()->save($creditCard);
            } else if($request->paymentOption == 'gcash') {
                $gCash = new Gcash([
                    'phone_number' => $request->mobile_number,
                    'amount' => $request->amount,
                ]);

                // Get the uploaded file
                $file = $request->file('gCashFile');

                // Define the file name (you can customize it as per your requirements)
                $fileName = time() . '_' . $file->getClientOriginalName();
        
                // Store the file in the public directory (you can change the storage path)
                $file->storeAs('public/assets/img/gcash_receipts', $fileName);
                $gCash->receipt_photo = $fileName;

                $gCash->user()->associate($user);
                $subscription->gcash()->save($gCash);
            } else {
                $manualPayment = new ManualPayment([
                    'full_name' => $request->fullName,
                    'amount' => $request->manual_payment_amount,
                ]);
                $manualPayment->user()->associate($user);
                $subscription->manualPayment()->save($manualPayment);
            }

            
            $sale = new Sale([
                'subscription_arrangement' => $subscriptionArrangement->arrangement_name,
                'tier_name' => $tier->tier_name,
                'date' => Carbon::now(),
                'payment_method' => $request->paymentOption,
                'customer_name' => $request->firstname.' '.$request->lastname,
                'amount' => $tier->price
            ]);
            $sale->subscription()->associate($subscription);
            $sale->save();
            
        }

        // Email User
        Mail::to(Auth::user())->send(new PaymentReceived());

        // redirect
        return redirect('member/membership-details')->with('success', 'Congratulations! You have successfully subscribed. We will notify you by email once we receive your payment at ' . Auth::user()->email);
    }

    /**
     * Get all subscriptions
     */
    public function subscribers() {
        $data['subscriptions'] = Subscription::orderBy('created_at', 'desc')->paginate(10);
        $data['staffs'] = User::where('role', 'staff')->where('status', 'active')->get();
        return view('management.subscribers', $data);
    }

    /**
     * Update subscription trainer
     */
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

    /**
     * 
     * Update Subscription Status
     */
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

    /**
     * View subscription
     */
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
            $data['subscriber'] = User::find($subscription->user_id);

            if($subscription->payment_option == 'credit card') {
                $data['creditCard'] = CreditCard::where('subscription_id', $subscription->id)->first();
            } else if ($subscription->payment_option == 'gcash') {
                $data['gCash'] = Gcash::where('subscription_id', $subscription->id)->first();
            } else if ($subscription->payment_option == 'manual payment') {
                $data['manualPayment'] = ManualPayment::where('subscription_id', $subscription->id)->first();
            }


            return view('management.view-subscription', $data);
        }

        return view('management.view-subscription', $data);
    }

    /**
     * Delete subscription
     */
    public function deleteSubscription($subscription_id) {
        $subscription = Subscription::find($subscription_id);
        if(!$subscription) {
            return response()->json([
                'message' => 'We can\'t find that subscription'
            ]); 
        }
        $subscription->delete();
        return response()->json([
            'message' => 'Subscription for <strong>'.ucwords($subscription->user->firstname.' '.$subscription->user->lastname).'</strong> successfully deleted.'
        ]);
    }



}   
