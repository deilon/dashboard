<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class StaffController extends Controller
{
    public function home() {
        return view('staff.home');
    }

    public function profile() {
        return view('staff.profile');
    }

    public function createStaff(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).+$/'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'role' => ['string', 'max:255', 'default:member'],
        ], [
            'password.regex' => 'Your password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.'
        ]);

        $user = User::create([
            'email' => strtolower($request->email),
            'password' => Hash::make(strtolower($request->password)),
            'firstname' => strtolower($request->firstName),
            'lastname' => strtolower($request->lastName),
            'role' => 'staff',
        ]);

        $user->save();
        return redirect()->back()->with('success', 'Staff successfully created.');
    }

    public function updateStaff(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($request->staffId)],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).+$/'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'role' => ['string', 'max:255', 'default:member'],
        ], [
            'password.regex' => 'Your password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.'
        ]);

        $user = User::find($request->staffId);
        $user->email = strtolower($request->email);
        $user->password = Hash::make(strtolower($request->password));
        $user->firstname = strtolower($request->firstName);
        $user->lastname = strtolower($request->lastName);
        $user->save();
        return redirect()->back()->with('success', 'Staff successfully created.');
    }
}
