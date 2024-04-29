<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


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
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();
    
    //     $request->session()->regenerate();
    
    //     $user = $request->user();
    
    //     if ($user instanceof Admin) {
    //         // Redirect admin users to the admin dashboard
    //         return redirect()->route('admin.course');
    //     } elseif ($user instanceof User) {
    //         // Redirect regular users to their dashboard
    //         return redirect()->route('dashboard');
    //     } else {
    //         // Handle other types of users or scenarios
    //         return redirect()->route('login');
    //     }
    // }
    
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.course');
        } elseif (Auth::guard('questioncreator')->attempt($credentials)) {
            return redirect()->route('questioncreator.course');
        } elseif (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }
    }




    /**
     * Destroy an authenticated session.
     */
    public function destroy(): RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
