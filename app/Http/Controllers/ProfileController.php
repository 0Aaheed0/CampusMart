<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $profile = $user->profile ?? new Profile([
            'department'      => null,
            'student_id'      => null,
            'batch'           => null,
            'year'            => null,
            'semester'        => null,
            'gender'          => null,
            'number'          => null,
            'profile_picture' => null,
        ]);

        return view('profile.edit', [
            'user'    => $user,
            'profile' => $profile,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255|unique:users,email,' . $user->id,
            'department'       => 'required|string|max:255',
            'student_id'       => 'required|string|max:50',
            'batch'            => 'required|string|max:50',
            'number'           => 'required|string|max:20',
            'gender'           => 'required|in:Male,Female,Other',
            'year'             => 'nullable|string',
            'semester'         => 'nullable|string',
            'profile_picture'  => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'current_password' => 'nullable|required_with:password|current_password',
            'password'         => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;

        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $profileData = $request->only([
            'department', 'student_id', 'batch', 'number', 'gender', 'year', 'semester'
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile && $user->profile->profile_picture) {
                Storage::disk('public')->delete($user->profile->profile_picture);
            }
            $profileData['profile_picture'] = $request->file('profile_picture')
                ->store('profiles', 'public');
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    // Log out BEFORE deleting so session is cleared properly
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Delete profile first (FK constraint), then user
    $user->profile()->delete();
    $user->delete();

    return Redirect::to('/');
}
}