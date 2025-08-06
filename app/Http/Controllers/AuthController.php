<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
    // route::get -> /register
    public function showRegister () : View {
        return view("auth.register");
    }

    // route::post -> /register
    public function register (RegisterRequest $request) : RedirectResponse {
        $user = User::create($request->validated());

        // Fires the Registered event
        // event(new Registered($user));

        Auth::login($user);

        return redirect()->route('contacts.index')->with('success', 'Welcome!');     
    }

    // route::get -> /login
    public function showLogin () : View {
        return view("auth.login");
    }

    // route::post -> /login
    public function login (LoginRequest $request) : RedirectResponse {
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'credentials' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('contacts.index')->with('success', 'Welcome!');

    }

    // route::post -> /logout
    public function logout (Request $request) : RedirectResponse{
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login')->with('success', 'You have been logged out!');
    }
}
