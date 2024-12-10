<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - APIIT Leisure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../images/logo.png">
</head>
<body class="bg-black min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/ChessHome.jpg') }}'); background-size: cover; background-position: center; font-family:Georgia;">
    <div class="bg-black px-8 py-12 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-white text-center mb-6">Welcome Back!</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300">E-mail</label>
                <input id="email" type="email" name="email" class="mt-2 block w-full px-4 py-2 bg-[#F3F3F3] rounded" required autofocus autocomplete="username" placeholder="Enter your email">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input id="password" type="password" name="password" class="mt-2 block w-full px-4 py-2 bg-[#F3F3F3] rounded" required autocomplete="current-password" placeholder="Enter your password">
            </div>

            <!-- Log In Button -->
            <div class="mb-4">
                <button type="submit" class="w-full text-white py-2 px-4 rounded hover:opacity-50" style="background-color:#8B0000; hover:opacity 0.5;">
                    Log In
                </button>
            </div>

            <!-- Sign Up Link -->
            <div class="text-center text-sm text-gray-400">
                New here? 
                <a href="{{ route('register') }}" class="hover:underline" style="color:#FF0000;">Sign Up instead</a>
            </div>
        </form>
    </div>
</body>
</html>
