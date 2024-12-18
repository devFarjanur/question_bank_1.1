<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

    public function CreateAdminForm()
    {
        return view('auth.admin_login');
    }

    public function QuestionCreatorLogin()
    {
        return view('auth.questioncreator_login');
    }


    public function StudentLogin()
    {
        return view('auth.student_login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $credentials['approved'] = true;
    
        if ($request->is('admin/login')) {
            // Attempt admin authentication
            if (Auth::guard('admin')->attempt($credentials)) {
                // Authentication successful for admin
                return redirect()->intended('/admin/dashboard');
            } else {
                // Authentication failed for admin
                Log::error('Admin login failed for email: ' . $credentials['email']);
                return back()->withInput()->withErrors([
                    'email' => 'These credentials do not match our records.',
                ]);
            }
        } else if ($request->is('teacher/login')) {

            if (Auth::guard('teacher')->attempt($credentials)) {

                return redirect()->intended('/teacher/dashboard');
            } else {

                Log::error('Course Teacher login failed for email: ' . $credentials['email']);
                return back()->withInput()->withErrors([
                    'email' => 'These credentials do not match our records.',
                ]);
            }
        } else if ($request->is('student/login')) {

            if (Auth::guard('student')->attempt($credentials)) {

                return redirect()->intended('/student/course');
            } else {

                Log::error('Student login failed for email: ' . $credentials['email']);
                return back()->withInput()->withErrors([
                    'email' => 'These credentials do not match our records.',
                ]);
            } 
        } else if ($request->is('login')) {
            // Attempt user authentication
            if (Auth::attempt($credentials)) {
                // Authentication successful for user
                return redirect()->intended('/dashboard');
            } else {
                // Authentication failed for user
                return back()->withInput()->withErrors([
                    'email' => 'These credentials do not match our records.',
                ]);
            }
        }
    
        // Default case
        return back()->withInput()->withErrors([
            'email' => 'Invalid login attempt.',
        ]);
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
