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


    
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            dd("Admin logged in"); // Add this line for debugging
            return redirect()->route('admin.course');
        } elseif (Auth::guard('questioncreator')->attempt($credentials)) {
            dd("Question Creator logged in"); // Add this line for debugging
            return redirect()->route('questioncreator.dashboard');
        } elseif (Auth::guard('web')->attempt($credentials)) {
            dd("User logged in"); // Add this line for debugging
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['email' => 'Invalid login credentials.']);
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
