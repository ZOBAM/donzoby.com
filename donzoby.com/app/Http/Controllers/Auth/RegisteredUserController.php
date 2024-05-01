<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Laravolt\Avatar\Facade as Avatar;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'min:2', 'max:25'],
            'last_name' => ['required', 'string', 'min:2', 'max:25'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['required', 'string', 'min:2', 'max:25'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // handle generation of avatar for new user
        try {
            $image_name = explode('@', $user->email)[0] . '.png';
            $avatar_uri = 'images/profile/' . $image_name;
            Avatar::create($user->first_name . ' ' . $user->last_name)->save($avatar_uri, 100);
            $user->avatar = $avatar_uri;
            $user->save();
        } catch (Exception $e) {
            Log::error('User avatar generation error.::' . $e->getMessage());
        }
        return redirect(route('user-area', absolute: false));
    }
}
