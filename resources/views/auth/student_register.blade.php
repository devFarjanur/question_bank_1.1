<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'figtree', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            /* Adjusted padding */
        }

        .form-container {
            max-width: 500px;
            /* Adjusted max-width */
            width: 100%;
            /* Added width */
            margin: auto;
            padding: 20px;
            /* Adjusted padding */
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        h4 {
            color: #333;
            margin-top: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
            /* Adjusted margin */
        }

        .form-control {
            font-size: 1rem;
            /* Adjusted font size */
            padding: 0.5rem;
            /* Adjusted padding */
            width: 100%;
            /* Added width */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            font-size: 1rem;
            /* Adjusted font size */
            padding: 0.5rem;
            /* Adjusted padding */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h4 class="text-center text-2xl font-bold mt-4 mb-4">Student Register</h4>

            <form method="POST" action="{{ route('student.register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        autocomplete="name" class="form-control">
                    <!-- Add error messages for name here if needed -->
                </div>

                <!-- Email Address -->
                <div class="form-group mt-4">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        autocomplete="username" class="form-control">
                    <!-- Add error messages for email here if needed -->
                </div>


                <!-- Phone -->
                <div class="form-group mt-4">
                    <label for="phone">Phone</label>
                    <input id="phone" type="phone" name="phone" value="{{ old('phone') }}" required
                        autocomplete="username" class="form-control">
                    <!-- Add error messages for email here if needed -->
                </div>

                <!-- Password -->
                <div class="form-group mt-4">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="form-control">
                    <!-- Add error messages for password here if needed -->
                </div>

                <!-- Confirm Password -->
                <div class="form-group mt-4">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" class="form-control">
                    <!-- Add error messages for password confirmation here if needed -->
                </div>

                <!-- Course Selection -->
                <div class="form-group mt-4">
                    <label for="course_id">Select Course</label>
                    <select id="course_id" name="course_id" class="form-control" required>
                        <option value="" selected disabled>-- Select Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                    <!-- Add error messages for course selection here if needed -->
                </div>

                <div class="form-group mt-4">
                    <a href="{{ route('student.login') }}">Already registered?</a>
                </div>

                <div class="form-group mt-4 mb-4">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional, if you need Bootstrap JavaScript functionality) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>