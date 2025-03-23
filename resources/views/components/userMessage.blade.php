<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @include('partials.nav') <!-- Sidebar component -->
    <div class="flex min-h-screen">
        <!-- Sidebar (fixed and responsive) -->
        @include('partials.sideNav') <!-- Sidebar component -->

        <!-- Main Content -->
        <div class="flex-1 p-6 ml-0 transition-all duration-300 ease-in-out">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-7xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">User Messages</h2>

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">#</th>
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">Subject</th>
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $index => $ticket)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 md:px-6 text-sm">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 md:px-6 text-sm">{{ $ticket->subject }}</td>
                                <td class="py-3 px-4 md:px-6 text-sm">
                                    <a href="{{ route('chat.show', ['ticket_id' => $ticket->id]) }}">
                                        <button class="px-3 py-1 md:px-4 md:py-2 rounded bg-red-500 text-white hover:bg-blue-700">
                                           Chat
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
