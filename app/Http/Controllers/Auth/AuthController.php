<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Use web guard for session (works in tests + browser)
        if (!Auth::guard('web')->attempt($credentials)) {
            return redirect()->back()->with('error', 'Invalid email or password. Please try again.');
        }

        $user = Auth::guard('web')->user();

        // Also issue JWT token for API use
        $token = null;
        try {
            $token = Auth::guard('api')->attempt($credentials);
        } catch (\Exception $e) {
            // JWT not available in test environment
        }

        $redirectUrl = $user->role === 'admin' ? '/admin/dashboard' : '/home';

        $response = redirect($redirectUrl);

        if ($token) {
            $response->withCookie(cookie('token', $token, config('jwt.ttl')));
        }

        return $response;
    }

    public function register(Request $request)
    {
        $adminEmails = AdminController::ADMIN_EMAILS;
        $isAdminEmail = in_array(strtolower($request->email), array_map('strtolower', $adminEmails));

        if ($isAdminEmail) {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $request->validate([
                    'password' => 'required|string|min:8|confirmed',
                ]);

                $user->update(['password' => Hash::make($request->password)]);

                Auth::guard('web')->login($user);

                return redirect('/admin/dashboard');
            }
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => [
                'required', 'string', 'email', 'max:255', 'unique:users',
                'regex:/^[A-Za-z0-9._%+-]+@aust\.edu$/i'
            ],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.regex'    => 'The email must be a valid @aust.edu address.',
            'password.min'   => 'The password must be at least 8 characters.',
        ]);

        $role = $isAdminEmail ? 'admin' : 'user';

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $role,
        ]);

        // Log in via web guard (session-based, works in tests)
        Auth::guard('web')->login($user);

        $redirectUrl = $user->role === 'admin' ? '/admin/dashboard' : '/home';

        return redirect($redirectUrl);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $cookie = cookie()->forget('token');

        return redirect('/')->withCookie($cookie);
    }
}