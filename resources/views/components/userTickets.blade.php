<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="bg-gray-100" x-data="{ openModal: false, ticketId: null, ticketSubject: '', ticketStatus: '' }">
    @include('partials.nav') <!-- Sidebar component -->
    <div class="flex min-h-screen">

        <!-- Sidebar (fixed and responsive) -->
        @include('partials.sideNav') <!-- Sidebar component -->

        <!-- Main Content -->
        <div class="flex-1 p-6 ml-0 transition-all duration-300 ease-in-out">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">User Tickets</h2>

                <!-- Table of Tickets -->
                <div class="overflow-x-auto rounded-lg shadow-sm">
                    <table class="min-w-full table-auto">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="py-4 px-6 text-left uppercase font-semibold text-sm">Ticket ID</th>
                                <th class="py-4 px-6 text-left uppercase font-semibold text-sm">Subject</th>
                                <th class="py-4 px-6 text-left uppercase font-semibold text-sm">Description</th>
                                <th class="py-4 px-6 text-left uppercase font-semibold text-sm">Category</th>
                                <th class="py-4 px-6 text-left uppercase font-semibold text-sm">Priority</th>
                                <th class="py-4 px-6 text-left uppercase font-semibold text-sm">Status</th> <!-- Added Status Column -->
                                <th class="py-4 px-6 text-left uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($tickets as $ticket)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-4 px-6">{{ $ticket->id }}</td>
                                <td class="py-4 px-6">{{ $ticket->subject }}</td>
                                <td class="py-4 px-6">{{ $ticket->description }}</td>
                                <td class="py-4 px-6">{{ $ticket->category }}</td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                                        {{ $ticket->priority === 'High' ? 'bg-red-100 text-red-700' :
                                           ($ticket->priority === 'Medium' ? 'bg-yellow-100 text-yellow-700' :
                                           'bg-green-100 text-green-700') }}">
                                        {{ $ticket->priority }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <!-- Status Display -->
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                                        {{ $ticket->status === 'Open' ? 'bg-blue-100 text-blue-700' :
                                           ($ticket->status === 'In Progress' ? 'bg-yellow-100 text-yellow-700' :
                                           ($ticket->status === 'Resolved' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700')) }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <!-- Edit Button -->
                                    <button @click="openModal = true; ticketId = {{ $ticket->id }}; ticketSubject = '{{ $ticket->subject }}'; ticketStatus = '{{ $ticket->status }}'"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Ticket -->
    <div x-show="openModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
        <div @click="openModal = false" class="absolute inset-0 bg-black opacity-25"></div>

        <div class="bg-white rounded-lg shadow-lg p-6 z-10 w-full max-w-lg">
            <h3 class="text-xl font-semibold text-blue-600 mb-4">Edit Ticket</h3>
            <form :action="`/admin/tickets/${ticketId}`" method="POST">
                @csrf
                @method('PUT')

                <!-- Ticket Subject -->
                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" id="subject" name="subject" x-model="ticketSubject" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Status Dropdown -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" x-model="ticketStatus" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        <option value="Open">Open</option>
                        <option value="In Progress">InProgress</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>

                <!-- Modal Actions -->
                <div class="flex justify-end">
                    <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg mr-2">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Toastify Script -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        function showToast(message, bgColor) {
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: bgColor,
                close: true
            }).showToast();
        }

        @if(session('success'))
        window.onload = function() {
            showToast("{{ session('success') }}", "green");
        };
        @endif
    </script>
</body>

</html>
