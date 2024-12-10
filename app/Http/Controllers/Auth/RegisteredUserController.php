<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                'unique:' . User::class,
                'regex:/^[a-zA-Z0-9._%+-]+@apiit\.lk$/',
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'sports' => ['required', 'array', 'min:1'],  // Validate that sports is an array and not empty
            'sports.*' => ['required', 'string'], // Ensure each sport in the array is a string
        ], [
            'email.regex' => 'The email must be an APIIT email address (@apiit.lk)',
        ]);

        // Create the user with validated data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sport_interest' => $request->sports,  // Store the selected sports as an array
        ]);

        // Fire the Registered event
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        // Redirect to the dashboard
        return redirect(route('dashboard'));
    }
}
