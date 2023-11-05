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
        return view('dashboard.member.home');
    }

    public function accountSettings() {
        return view('dashboard.member.account');
    }

    public function changePassword() {
        return view('dashboard.member.change-password');
    }

    public function packages() {
        return view('dashboard.member.packages');
    }

    public function updateProfile(Request $request) {
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
            'photo' => ['sometimes', 'image', 'max:2048']
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

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $defaultImageFilename = 'default.jpg';
    
            // Check if the uploaded file's original filename matches the default image filename
            if ($file->getClientOriginalName() !== $defaultImageFilename) {
                $oldPhoto = $user->photo;
                // Handle uploading the new photo
                $filename = $file->hashName();
                $imagePath = $file->storeAs('public/assets/img/avatars', $filename);
                $user->photo = $filename;

                
                    Storage::delete('public/assets/img/avatars/' . $oldPhoto);
            } 
        } else {
            // Reset profile photo
            // To reset profile photo we should also delete the old photo
            Storage::delete('public/assets/img/avatars/' . Auth::user()->photo);
            $user->photo = null;
        }


        $user->save();

        // redirect
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).+$/'],
        ], [
            'password.regex' => 'Your password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.'
        ]);
    
        $user = Auth::user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }
    
        $user->update([
            'password' => Hash::make(strtolower($request->password)),
        ]);
    
        return redirect()->back()->with('success', 'Password updated successfully.');
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

            $data['assigned_staff'] = User::find($subscription->assigned_staff_id);

            if($subscription->payment_option == 'credit card') {
                $data['creditCard'] = CreditCard::where('subscription_id', $subscription->id)->first();
            } else if ($subscription->payment_option == 'gcash') {
                $data['gCash'] = Gcash::where('subscription_id', $subscription->id)->first();
            } else if ($subscription->payment_option == 'manual payment') {
                $data['manualPayment'] = ManualPayment::where('subscription_id', $subscription->id)->first();
            }


            return view('dashboard.member.membership-details', $data);
        }

        return view('dashboard.member.membership-details', $data);
    }

}
