<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function QuestionCreatorRegister(): View
    {
        $courses = Course::all();
        return view('auth.questionCreator_register', compact('courses'));
    }


    public function StudentRegister(): View
    {
        $courses = Course::all();
        return view('auth.student_register', compact('courses'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }



    /**
     * Handle an incoming registration request for question creator.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function QuestionCreatorRegisterStore(Request $request): RedirectResponse
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Create the question creator
        $teacher = new Teacher();
        $teacher->name = $validatedData['name'];
        $teacher->email = $validatedData['email'];
        $teacher->phone = $validatedData['phone'];
        $teacher->password = bcrypt($validatedData['password']);
        $teacher->course_id = $validatedData['course_id'];
        $teacher->save();



        $notification = array(
            'message' => 'Course Teacher registered successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('questioncreator.login')->with($notification);

    }


    /**
     * Handle an incoming registration request for question creator.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function StudentRegisterStore(Request $request): RedirectResponse
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'course_id' => 'required|exists:courses,id',
        ]);



        // Create the question creator
        $student = new Student();
        $student->name = $validatedData['name'];
        $student->email = $validatedData['email'];
        $student->phone = $validatedData['phone'];
        $student->password = bcrypt($validatedData['password']);
        $student->course_id = $validatedData['course_id'];
        $student->save();



        $notification = array(
            'message' => 'Student registered successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('student.login')->with($notification);

    }




}
