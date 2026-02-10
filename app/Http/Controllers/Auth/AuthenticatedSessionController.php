<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth('api')->attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

         // Set the cookie (valid for 60 minutes)
         $cookie = cookie('token', $token, 60);

        return redirect()->route('dashboard')->withCookie($cookie);
    }

    /**
     * Destroy an authenticated session.
     */
   public function destroy()
    {
        auth('api')->logout();
        $cookie = cookie()->forget('token');
        return redirect('/login')->withCookie($cookie);
    }
}
