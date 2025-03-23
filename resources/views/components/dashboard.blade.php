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

        @include('partials.sideNav')

        <div class="flex-1 p-6 ml-0  transition-all duration-300 ease-in-out">
            <h2 class="text-3xl font-bold text-blue-600 mb-8">Welcome to the Dashboard</h2>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Overview</h3>
                <p class="text-gray-600">
                    This is your dashboard. You can add more functionality or content here as needed.
                </p>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Activity</h3>
                    <p class="text-gray-600">
                        No recent activity to display.
                    </p>
                </div>


            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
