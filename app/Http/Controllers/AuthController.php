<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    /**
     * Handle all users authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role == 'admin') {
                return redirect('admin/dashboard');
            }else if (auth()->user()->role == 'member') {
                return redirect('member/dashboard');
            }else{
                return redirect('staff/dashboard');
            }
        }
 
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
        return back()->withErrors([
            'error_login' => 'Invalid credentials. Please check your username/email and password.',
        ])->withInput();
    }

    /**
     * Handle members registration attempt.
     */
    public function registerMember(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users'],
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

        return redirect('member/dashboard');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('home');
    }
}
