<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="relative">
    <!-- Background with Inline CSS and Opacity -->
    <div class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('https://t3.ftcdn.net/jpg/06/29/70/06/360_F_629700666_zBUP3WZdKFLnnhMAEuGpsoOOVWeNkKBW.jpg');">
        <!-- Overlay with Opacity -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    </div>

    <!-- Login Form Container -->
    <div class="min-h-screen flex items-center justify-center relative">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md relative overflow-hidden">
            <!-- Red Corner - Top Left -->
            <div class="absolute top-0 left-0 w-16 h-16 bg-blue-300 transform origin-bottom-right rotate-45"></div>

            <!-- Red Corner - Bottom Right -->
            <div class="absolute bottom-0 right-0 w-16 h-16 bg-blue-300 transform origin-top-left rotate-45"></div>

            <h2 class="text-2xl font-bold text-center text-blue-600">Welcome</h2>

            <!-- Display Errors -->
            @if(session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="bg-red-500 text-white p-2 my-4 rounded">
                {{ session('error') }}
            </div>
            @endif

            <!-- Display Success Message -->
            @if(session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="bg-green-500 text-white p-2 my-4 rounded">
                {{ session('success') }}
            </div>
            @endif

            <!-- Form -->
            <form action="{{ url('/login') }}" method="POST" class="mt-6">
                @csrf
                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" id="username" name="username" required
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Login
                </button>
            </form>


            <!-- Links -->
            <p class="text-gray-600 mt-4 text-center">
                Don't have an account? <a href="/signup" class="text-blue-500 hover:underline">Sign Up</a>
            </p>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
