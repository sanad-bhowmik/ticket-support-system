<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    @include('partials.nav') <!-- Sidebar component -->
    <div class="flex min-h-screen">

        <!-- Sidebar (fixed and responsive) -->
        @include('partials.sideNav') <!-- Sidebar component -->

        <!-- Main Content -->
        <div class="flex-1 p-6 ml-0 md:ml-64 transition-all duration-300 ease-in-out">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
                <h2 class="text-3xl font-bold text-center text-blue-600 mb-4">Welcome to the Dashboard</h2>
                <p class="text-gray-700 text-lg">This is your dashboard. You can add more functionality here.</p>
            </div>
        </div>

    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
