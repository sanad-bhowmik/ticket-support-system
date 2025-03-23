<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>

<body class="relative">
    <!-- Background with Inline CSS and Opacity -->
    <div class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('https://img.freepik.com/free-photo/wood-sideboard-green-living-room-with-copy-space_43614-916.jpg');">
        <!-- Overlay with Opacity -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    </div>

    <!-- Sign-Up Form Container -->
    <div class="min-h-screen flex items-center justify-center relative">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">

            <h2 class="text-2xl font-bold text-center text-blue-600">Create Your Account</h2>

            <!-- Display Errors -->
            @if($errors->any())
            <div class="bg-red-500 text-white p-2 my-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Display Success Message -->
            @if(session('success'))
            <div class="bg-green-500 text-white p-2 my-4 rounded">{{ session('success') }}</div>
            @endif

            <!-- Form -->
            <form action="{{ route('signup') }}" method="POST" class="mt-6">
                @csrf

                <!-- Full Name -->
                <div class="mb-4">
                    <label for="full_name" class="block text-gray-700">Full Name</label>
                    <input type="text" id="full_name" name="full_name" required
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label for="user_name" class="block text-gray-700">Username</label>
                    <input type="text" id="user_name" name="user_name" required
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                </div>

                <!-- Password -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 pr-10">
                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 mt-7 cursor-pointer"
                        onclick="togglePasswordVisibility()">
                        <i id="eye-icon" class="fas fa-eye"></i>
                    </span>
                </div>

                <!-- Terms and Conditions -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="terms" name="terms" required
                        class="mr-2 border border-gray-400 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    <label for="terms" class="text-gray-700">I agree to the <a href="#" class="text-blue-500 hover:underline">Terms and Conditions</a></label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Sign Up
                </button>
            </form>

            <!-- Links -->
            <p class="text-gray-600 mt-4 text-center">
                Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
            </p>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
