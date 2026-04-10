<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Google\Client;

class GoogleOneTapController extends Controller
{
    /**
     * Handle Google One Tap token
     * This receives the JWT token from Google One Tap and authenticates the user
     */
    public function handleOneTap(Request $request)
    {
        $request->validate([
            'credential' => 'required|string',
        ]);

        try {
            // Verify the token with Google
            $client = new Client();
            $client->setClientId(env('GOOGLE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
            $client->setApplicationName('CampusMart');
            
            // Verify the JWT token
            $ticket = $client->verifyIdToken($request->credential);
            
            if (!$ticket) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid token'
                ], 401);
            }

            $payload = $ticket;
            $email = $payload['email'] ?? null;
            $name = $payload['name'] ?? null;
            $picture = $payload['picture'] ?? null;
            $googleId = $payload['sub'] ?? null;

            if (!$email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to retrieve email from token'
                ], 400);
            }

            // Check if user exists
            $user = User::where('email', $email)->first();

            if ($user) {
                // User exists, just log them in
                Auth::login($user, true);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $name ?? 'User',
                    'email' => $email,
                    'password' => bcrypt(str_random(32)), // Random password
                    'avatar' => $picture,
                    'role' => 'user',
                ]);

                Auth::login($user, true);
            }

            return response()->json([
                'success' => true,
                'message' => 'Successfully authenticated',
                'redirect' => route('home')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication failed: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Handle One Tap sign out
     */
    public function handleOneTapSignOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
