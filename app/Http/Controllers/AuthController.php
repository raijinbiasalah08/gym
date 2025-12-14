<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
            
            // Skip approval checks for admin users
            if ($user->role !== 'admin') {
                // Check approval status
                if ($user->approval_status === 'pending') {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Your account is pending admin approval. Please wait for confirmation.']);
                }
                
                if ($user->approval_status === 'rejected') {
                    Auth::logout();
                    $reason = $user->rejection_reason ? ' Reason: ' . $user->rejection_reason : '';
                    return back()->withErrors(['email' => 'Your registration has been rejected.' . $reason]);
                }
            }
            
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
        // Base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:member,trainer',
            'phone' => 'required|string|max:20',
            'sex' => 'required|in:male,female',
            'date_of_birth' => 'required|date|before:-13 years',
        ];

        // Add trainer-specific validation
        if ($request->role === 'trainer') {
            $rules['valid_id'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'; // 5MB
            $rules['certification_files.*'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth,
            'is_active' => false, // Set to false until approved
            'approval_status' => 'pending', // New registrations require approval
        ];

        // Add role-specific fields
        if ($request->role === 'member') {
            // Membership type will be selected in the next step
            $userData['membership_type'] = 'basic'; // Default, will be updated
            $userData['membership_expiry'] = now()->addMonth();
        } elseif ($request->role === 'trainer') {
            $userData['specialization'] = $request->specialization;
            $userData['experience_years'] = $request->experience_years;
            $userData['hourly_rate'] = $request->hourly_rate ?? 50.00;
        }

        $user = User::create($userData);

        // Handle trainer document uploads
        if ($request->role === 'trainer') {
            $documentPath = 'trainer_documents/' . $user->id;

            // Store Valid ID
            if ($request->hasFile('valid_id')) {
                $validIdPath = $request->file('valid_id')->store($documentPath, 'public');
                $user->update(['valid_id_path' => $validIdPath]);
            }

            // Store Certifications
            if ($request->hasFile('certification_files')) {
                $certPaths = [];
                foreach ($request->file('certification_files') as $certFile) {
                    $certPath = $certFile->store($documentPath, 'public');
                    $certPaths[] = $certPath;
                }
                $user->update(['certifications' => json_encode($certPaths)]);
            }
        }

        // For members, redirect to plan selection page
        if ($request->role === 'member') {
            // Store user info in session for plan selection
            session(['pending_plan_user_id' => $user->id]);
            session(['user_name' => $user->name]);
            return redirect()->route('select-plan');
        }

        // For trainers, create notifications and redirect to pending approval
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'type' => 'user_registration',
                'title' => 'New Trainer Registration',
                'message' => $user->name . ' has registered as a trainer with verification documents and is pending approval.',
                'icon' => 'fas fa-user-plus',
                'color' => 'info',
                'link' => '/admin/user-approvals',
                'is_read' => false,
            ]);
        }

        return redirect()->route('pending-approval')->with('email', $user->email);
    }

    public function showPlanSelection()
    {
        // Check if user has a pending plan selection
        if (!session('pending_plan_user_id')) {
            return redirect()->route('register')->withErrors(['error' => 'Please complete registration first.']);
        }

        return view('auth.select-plan');
    }

    public function savePlanSelection(Request $request)
    {
        // Validate plan selection
        $request->validate([
            'membership_type' => 'required|in:basic,premium,vip',
            'payment_method' => 'required|in:visa,mastercard,amex,jcb,gcash,paymaya,alipay,wechat,bdo,bancnet,tendopay,paypal,cash',
        ]);

        $userId = session('pending_plan_user_id');
        if (!$userId) {
            return redirect()->route('register')->withErrors(['error' => 'Session expired. Please register again.']);
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('register')->withErrors(['error' => 'User not found. Please register again.']);
        }

        // Update user's membership type
        $user->update([
            'membership_type' => $request->membership_type,
        ]);

        // Clear session data
        session()->forget(['pending_plan_user_id', 'user_name']);

        // Create notifications for all admins about the new registration
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'type' => 'user_registration',
                'title' => 'New Member Registration',
                'message' => $user->name . ' has registered as a member (' . ucfirst($request->membership_type) . ' plan) and is pending approval.',
                'icon' => 'fas fa-user-plus',
                'color' => 'info',
                'link' => '/admin/user-approvals',
                'is_read' => false,
            ]);
        }

        return redirect()->route('pending-approval')->with('email', $user->email);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
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