<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Login method
    public function authenticate(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $login = $request->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [$field => $login, 'password' => $request->password];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->isAdmin()) {
                Log::info('Admin login successful for: ' . $user->email);
                return redirect()->route('admindashboard')->with('success', 'Welcome Admin!');
            }

            Log::info('User login successful for: ' . $user->email);

            // Redirect to intended page (checkout) or dashboard by default
            return redirect()->intended(route('checkout'))->with('success', 'Login successful!');
        }

        return back()->withInput($request->only('login'))->withErrors([
            'login' => 'Invalid credentials.',
        ]);
    }

    // Logout
    public function signOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/dashboard')->with('success', 'You have been logged out successfully');
    }
}
