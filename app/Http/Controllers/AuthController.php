<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is deactivated.']);
            }

            return redirect()->intended($this->getDashboardRoute($user->role));
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:member,trainer',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'is_active' => $request->role === 'member' ? true : false,
        ];

        // Add role-specific fields
        if ($request->role === 'member') {
            $userData['membership_type'] = 'basic';
            $userData['membership_expiry'] = now()->addMonth();
        } elseif ($request->role === 'trainer') {
            $userData['specialization'] = $request->specialization;
            $userData['certifications'] = $request->certifications;
            $userData['experience_years'] = $request->experience_years;
            $userData['hourly_rate'] = $request->hourly_rate ?? 50.00;
        }

        $user = User::create($userData);

        Auth::login($user);

        return redirect()->intended($this->getDashboardRoute($user->role));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function getDashboardRoute($role)
    {
        return match($role) {
            'admin' => '/admin/dashboard',
            'trainer' => '/trainer/dashboard',
            'member' => '/member/dashboard',
            default => '/'
        };
    }
}