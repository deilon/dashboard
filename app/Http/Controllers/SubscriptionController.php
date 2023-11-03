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
            $subscription->status = 'active';
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

            if($request->paymentOption == 'creditCard') {
                $subscription->payment_option = 'credit card';
            } else if($request->paymentOption == 'gcash') {
                $subscription->payment_option = 'gcash';
            } else {
                $subscription->payment_option = 'manual payment';
            }
    
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
            
        }

        // redirect
        return redirect('member/membership-details')->with('success', 'You have successfully subscribed.');

    }

}
