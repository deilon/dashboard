<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).+$/'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'role' => ['string', 'max:255', 'default:member'],
        ], [
            'password.regex' => 'Your password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.'
        ]);

        $user = User::create([
            'email' => strtolower($request->email),
            'password' => Hash::make(strtolower($request->password)),
            'firstname' => strtolower($request->firstname),
            'lastname' => strtolower($request->lastname),
            'role' => 'member',
        ]);

        event(new Registered($user));

        $request->session()->flash('welcome_message', 'Welcome, ' . $user->firstname . '! Your account has been created.');

        Auth::login($user);

        return redirect('dashboard');
    }
}
