<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add a fun font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-50 to-purple-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center bg-white p-8 rounded-lg shadow-2xl w-full max-w-md transform transition-all duration-500 hover:scale-105">
            <!-- Illustration -->
            <img src="https://cdn-icons-png.flaticon.com/512/755/755014.png" alt="404 Illustration" class="w-48 h-48 mx-auto mb-6 animate-bounce">

            <!-- Error Code -->
            <h1 class="text-8xl font-bold text-red-600 mb-4">404</h1>

            <!-- Error Message -->
            <p class="text-xl text-gray-600 mb-6">Oops! The page you're looking for doesn't exist.</p>

            <!-- Home Button -->
            <div class="mt-6">
                <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Go to Home
                </a>
            </div>
        </div>
    </div>
</body>

</html>
