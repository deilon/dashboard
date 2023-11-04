<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Subscription;

class AdminController extends Controller
{
    public function home() {
        return view('dashboard.admin.home');
    }

    public function accountSettings() {
        return view('dashboard.admin.account');
    }

    public function changePassword() {
        return view('dashboard.admin.change-password');
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

    public function usersRecords($role) {
        $data['users'] = User::where('role', $role)->paginate(10);
        $data['role'] = $role;
        return view('dashboard.admin.users-records', $data);
    }

    public function subscribers() {
        $data['subscriptions'] = Subscription::paginate(10);
        $data['staffs'] = User::where('role', 'staff')->where('status', 'active')->get();
        return view('dashboard.admin.subscribers', $data);
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
        return view('dashboard.admin.view-profile', $data);
    }

    public function deleteUser($user_id) {
        $user = User::find($user_id);
        $user->delete();
        return response()->json([
            'message' => '<strong>'.$user->firstname.' '.$user->lastname.'</strong> successfully deleted.'
        ]); 
    }
}
