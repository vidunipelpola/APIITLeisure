<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Remove a sport from user's interests.
     */
    public function leaveSport(Request $request): RedirectResponse
    {
        $user = $request->user();
        $sport = $request->input('sport');
        
        // Get current sports array or empty array if null
        $currentSports = $user->sport_interest ?? [];
        
        // Remove the sport if it exists
        if (($key = array_search($sport, $currentSports)) !== false) {
            unset($currentSports[$key]);
            $user->sport_interest = array_values($currentSports); // Re-index array
            $user->save();
        }

        return Redirect::route('profile.edit')->with('status', 'sport-left');
    }

    /**
     * Add a sport to user's interests.
     */
    public function joinSport(Request $request): RedirectResponse
    {
        $user = $request->user();
        $sport = $request->input('sport');
        
        // Get current sports array or empty array if null
        $currentSports = $user->sport_interest ?? [];
        
        // Add the sport if it doesn't exist
        if (!in_array($sport, $currentSports)) {
            $currentSports[] = $sport;
            $user->sport_interest = $currentSports;
            $user->save();
        }

        return Redirect::route('profile.edit')->with('status', 'sport-joined');
    }
}
