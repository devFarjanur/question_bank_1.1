<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
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
            padding: 20px; /* Adjusted padding */
        }
        .form-container {
            max-width: 500px; /* Adjusted max-width */
            width: 100%; /* Added width */
            margin: auto;
            padding: 20px; /* Adjusted padding */
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        h4 {
            color: #333;
            margin-top: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1rem; /* Adjusted margin */
        }
        .form-control {
            font-size: 1rem; /* Adjusted font size */
            padding: 0.5rem; /* Adjusted padding */
            width: 100%; /* Added width */
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            font-size: 1rem; /* Adjusted font size */
            padding: 0.5rem; /* Adjusted padding */
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
            <h4 class="text-center text-2xl font-bold mt-4 mb-4">Student Login</h4>

            <!-- Session Status -->
            <!-- Add Session Status section here if needed -->

            <form method="POST" action="{{ route('student.login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control">
                    <!-- Add error messages for email here if needed -->
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control">
                    <!-- Add error messages for password here if needed -->
                </div>

                <!-- Remember Me -->
                <div class="form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">Remember me</label>
                </div>

                <!-- Forgot password link -->
                <div class="form-group mt-4">
                    <a href="#">Forgot your password?</a>
                </div>

                <!-- Login Button -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Log in</button>
                </div>

                <!-- Register link -->
                <div class="form-group mb-4">
                    <a href="{{ route('student.register') }}">New Here? Register</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional, if you need Bootstrap JavaScript functionality) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
