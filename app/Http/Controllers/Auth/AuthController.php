<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // No middleware in constructor, web routes will handle it.
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show the application's registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (! $token = Auth::attempt($credentials)) {
            return redirect()->back()->with('error', 'Invalid email or password. Please try again.');
        }

        $user = Auth::user();
        $redirectUrl = $user->role === 'admin' ? '/admin/dashboard' : '/home';

        // Set the JWT token in a cookie and go to home
        return redirect($redirectUrl)->withCookie(cookie('token', $token, config('jwt.ttl')));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $adminEmails = AdminController::ADMIN_EMAILS;

        $isAdminEmail = in_array(strtolower($request->email), array_map('strtolower', $adminEmails));

        // For admin emails, check if user already exists and just update password
        if ($isAdminEmail) {
            $user = User::where('email', $request->email)->first();
            
            if ($user) {
                // Admin email already exists, update the password and log them in
                $request->validate([
                    'password' => 'required|string|min:8|confirmed',
                ], [
                    'password.min' => 'The password must be at least 8 characters.'
                ]);

                $user->update([
                    'password' => Hash::make($request->password),
                ]);

                // Automatically log in the user
                $token = Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ]);

                return redirect('/admin/dashboard')->withCookie(cookie('token', $token, config('jwt.ttl')));
            }
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users', 
                'regex:/^[A-Za-z0-9._%+-]+@aust\.edu$/i'
            ],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.regex' => 'The email must be a valid @aust.edu address.',
            'password.min' => 'The password must be at least 8 characters.'
        ]);

        $role = $isAdminEmail ? 'admin' : 'user';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        // Automatically log in the user after registration
        $token = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $redirectUrl = $user->role === 'admin' ? '/admin/dashboard' : '/home';

        return redirect($redirectUrl)->withCookie(cookie('token', $token, config('jwt.ttl')));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Expire the JWT token cookie
        $cookie = cookie()->forget('token');

        return redirect('/')->withCookie($cookie);
    }
}