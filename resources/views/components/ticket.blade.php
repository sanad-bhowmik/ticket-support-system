<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="bg-gray-100">

    @include('partials.nav') <!-- Include Top Navigation -->
    <div class="flex min-h-screen">
        @include('partials.sideNav') <!-- Include Sidebar -->

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-6 transition-all duration-300 ease-in-out">
            <div class="bg-white p-4 md:p-8 rounded-lg shadow-md w-full max-w-screen-xl mx-auto">

                <!-- Flex container for title and button -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-blue-600 mb-4 md:mb-0">Tickets</h2>

                    <!-- Generate Ticket Button -->
                    <button id="generateTicketBtn" class="bg-blue-500 text-white px-4 py-2 md:px-6 md:py-3 rounded-lg flex items-center hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-plus mr-2"></i> Generate Ticket
                    </button>
                </div>

                <p class="text-gray-700 mb-4">Manage your tickets here.</p>

                <!-- Ticket Table -->
                <div class="overflow-x-auto shadow-lg rounded-lg">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">#</th>
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">Title</th>
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">Category</th>
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">Priority</th>
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">Status</th> <!-- Added Status Column -->
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">Actions</th>
                                <th class="py-3 px-4 md:px-6 text-left text-sm font-semibold">Chat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $index => $ticket)
                            <tr class="border-b hover:bg-gray-50">
                                <!-- Display Index Number Instead of Ticket ID -->
                                <td class="py-3 px-4 md:px-6 text-sm">{{ $index + 1 }}</td>

                                <td class="py-3 px-4 md:px-6 text-sm">{{ $ticket->subject }}</td>
                                <td class="py-3 px-4 md:px-6 text-sm">{{ $ticket->category }}</td>
                                <td class="py-3 px-4 md:px-6 text-sm">
                                    <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs md:text-sm">
                                        {{ $ticket->priority }}
                                    </span>
                                </td>

                                <!-- Status Column -->
                                <td class="py-3 px-4 md:px-6 text-sm">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                {{ $ticket->status === 'Open' ? 'bg-blue-100 text-blue-700' :
                ($ticket->status === 'In Progress' ? 'bg-yellow-100 text-yellow-700' :
                ($ticket->status === 'Resolved' ? 'bg-green-100 text-green-700' :
                'bg-gray-100 text-gray-700')) }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>

                                <!-- Actions Column -->
                                <td class="py-3 px-4 md:px-6 text-sm space-x-1">
                                    @if($ticket->status !== 'Closed')
                                    <button class="text-black px-3 py-1 md:px-4 md:py-2 rounded"
                                        onclick="openEditModal({{ $ticket->id }}, '{{ $ticket->subject }}', '{{ $ticket->description }}')"
                                        title="Edit">
                                        <img src="{{ asset('img/pen.png') }}" alt="Edit" class="w-8 h-8">
                                    </button>
                                    <button class="text-black px-3 py-1 md:px-4 md:py-2 rounded"
                                        onclick="openDeleteModal({{ $ticket->id }})"
                                        title="Delete">
                                        <img src="{{ asset('img/bin.png') }}" alt="Delete" class="w-8 h-8">
                                    </button>
                                    @endif
                                </td>

                                <!-- Chat Column -->
                                <td class="py-3 px-4 md:px-6 text-sm space-x-2">
                                    @if($ticket->status !== 'Closed')
                                    <a href="{{ route('messages.show', ['ticket_id' => $ticket->id]) }}">
                                        <button class="px-3 py-1 md:px-4 md:py-2 rounded" title="Chat">
                                            <img src="{{ asset('img/chat.png') }}" alt="Chat" class="w-6 h-6">
                                        </button>
                                    </a>
                                    @else
                                    <span class="text-gray-500">Chat Disabled</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Edit Ticket Modal -->
    <div id="editTicketModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-xl w-11/12 md:w-full max-w-lg">
            <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">Edit Ticket</h3>
            <form id="editTicketForm" action="{{ route('ticket.update', ['ticket' => 0]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_subject" class="block text-gray-700">Subject</label>
                    <input type="text" id="edit_subject" name="subject" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="edit_description" class="block text-gray-700">Description</label>
                    <textarea id="edit_description" name="description" class="w-full p-3 border border-gray-300 rounded-lg" rows="4" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Save Changes</button>
                </div>
            </form>
            <button id="closeEditModalBtn" class="absolute top-3 right-3 text-gray-600 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-xl w-11/12 md:w-full max-w-lg">
            <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">Are you sure?</h3>
            <p class="text-gray-700 mb-6">Do you really want to delete this ticket? This action cannot be undone.</p>
            <form id="deleteTicketForm" method="POST" class="flex justify-end">
                @csrf
                @method('DELETE')
                <button type="button" id="cancelDeleteBtn" class="bg-gray-500 text-white px-6 py-2 rounded-lg mr-4 hover:bg-gray-700">Cancel</button>
                <button type="submit" id="confirmDeleteBtn" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>

    <!-- Create Ticket Modal -->
    <div id="ticketModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-xl w-11/12 md:w-full max-w-lg">
            <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">Create New Ticket</h3>
            <form id="ticketForm" action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="subject" class="block text-gray-700">Subject</label>
                    <input type="text" id="subject" name="subject" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea id="description" name="description" class="w-full p-3 border border-gray-300 rounded-lg" rows="4" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-gray-700">Category</label>
                    <select id="category" name="category" class="w-full p-3 border border-gray-300 rounded-lg">
                        <option value="technical">Technical</option>
                        <option value="billing">Billing</option>
                        <option value="general">General</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="priority" class="block text-gray-700">Priority</label>
                    <select id="priority" name="priority" class="w-full p-3 border border-gray-300 rounded-lg">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="file" class="block text-gray-700">Attachment</label>
                    <input type="file" id="file" name="file" class="w-full p-3 border border-gray-300 rounded-lg">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Create</button>
                </div>
            </form>
            <button id="closeModalBtn" class="absolute top-3 right-3 text-gray-600 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

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

    <script>
        // Edit Modal
        function openEditModal(ticketId, ticketSubject, ticketDescription) {
            document.getElementById("editTicketModal").classList.remove("hidden");
            document.getElementById("editTicketForm").action = "/tickets/" + ticketId;
            document.getElementById("edit_subject").value = ticketSubject;
            document.getElementById("edit_description").value = ticketDescription;
        }

        document.getElementById("closeEditModalBtn").onclick = function() {
            document.getElementById("editTicketModal").classList.add("hidden");
        };

        // Delete Modal
        function openDeleteModal(ticketId) {
            document.getElementById("deleteModal").classList.remove("hidden");
            document.getElementById("deleteTicketForm").action = "/tickets/" + ticketId;
        }

        document.getElementById("cancelDeleteBtn").onclick = function() {
            document.getElementById("deleteModal").classList.add("hidden");
        };

        // Create Ticket Modal
        document.getElementById("generateTicketBtn").onclick = function() {
            document.getElementById("ticketModal").classList.remove("hidden");
        };

        document.getElementById("closeModalBtn").onclick = function() {
            document.getElementById("ticketModal").classList.add("hidden");
        };

        // Reset form after submission
        document.getElementById("ticketForm").onsubmit = function() {
            setTimeout(function() {
                document.getElementById("ticketForm").reset();
                document.getElementById("ticketModal").classList.add("hidden");
            }, 3000);
        };

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById("editTicketModal")) {
                document.getElementById("editTicketModal").classList.add("hidden");
            }
            if (event.target == document.getElementById("deleteModal")) {
                document.getElementById("deleteModal").classList.add("hidden");
            }
            if (event.target == document.getElementById("ticketModal")) {
                document.getElementById("ticketModal").classList.add("hidden");
            }
        };
    </script>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
