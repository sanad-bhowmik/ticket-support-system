<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages for Ticket: {{ $ticket->subject }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Include Echo and Pusher -->
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Include Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="bg-gray-50 font-sans">
    @include('partials.nav') <!-- Include top navigation -->

    <div class="flex min-h-screen">
        @include('partials.sideNav') <!-- Include sidebar -->

        <!-- Main Content Area -->
        <div class="flex-1 p-4 md:p-6 transition-all duration-300 ease-in-out">
            <div class="bg-white p-6 md:p-8 rounded-lg shadow-xl w-full max-w-screen-xl mx-auto">
                <!-- Ticket Subject -->
                <div class="mb-8">
                    <h2 class="text-4xl font-semibold text-blue-600">{{ $ticket->subject }}</h2>
                    <p class="text-lg text-gray-500 mt-2">Chat and track messages for this ticket.</p>
                </div>

                <!-- Chat Container -->
                <div class="flex flex-col h-[70vh] bg-gray-50 rounded-lg shadow-inner p-6 space-y-6">
                    <!-- Chat Messages Area -->
                    <div id="chatMessages" class="flex-1 overflow-y-auto space-y-4 mb-6">
                        <!-- Display previous messages from the database -->
                        @foreach ($messages as $message)
                            <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="{{ $message->user_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200' }} p-4 rounded-lg max-w-[70%] shadow-sm">
                                    <p class="text-base">{{ $message->message }}</p>
                                    <span class="text-xs {{ $message->user_id === auth()->id() ? 'text-gray-200' : 'text-gray-600' }} block mt-1">
                                        {{ $message->created_at->format('h:i A') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Message Input Area -->
                    <div class="flex items-center space-x-4">
                        <input type="text" id="messageInput" placeholder="Type your message..." class="flex-1 p-4 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all ease-in-out duration-300 placeholder-gray-500">
                        <button id="sendMessageBtn" class="bg-blue-600 text-white p-4 rounded-xl hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to add a new message to the chat
        function addMessage(message, isSender = true) {
            const chatMessages = document.getElementById('chatMessages');
            const messageElement = document.createElement('div');
            messageElement.classList.add('flex', 'justify-' + (isSender ? 'end' : 'start'));

            const messageContent = `
                <div class="${isSender ? 'bg-blue-500 text-white' : 'bg-gray-200'} p-4 rounded-lg max-w-[70%] shadow-sm">
                    <p class="text-base">${message}</p>
                    <span class="text-xs ${isSender ? 'text-gray-200' : 'text-gray-600'} block mt-1">${new Date().toLocaleTimeString()}</span>
                </div>
            `;

            messageElement.innerHTML = messageContent;
            chatMessages.appendChild(messageElement);

            // Scroll to the bottom of the chat
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Send message on button click
        document.getElementById('sendMessageBtn').addEventListener('click', function() {
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value.trim();

            if (message) {
                addMessage(message, true); // Add sender's message
                messageInput.value = ''; // Clear input

                // Send message to the server via an API call using Axios
                axios.post('/messages/{{ $ticket->id }}', { message: message })
                    .then(response => {
                        console.log('Message sent successfully:', response.data);  // Debugging
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);  // Debugging
                    });
            }
        });

        // Send message on pressing Enter key
        document.getElementById('messageInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('sendMessageBtn').click();
            }
        });

        // Set up Laravel Echo and listen for new messages in real-time
        const ticketId = {{ $ticket->id }};
        const echo = new Echo({
            broadcaster: 'pusher',
            key: '899888f73c80f82f8426',  // Your Pusher Key
            cluster: 'mt1',  // Your Pusher Cluster
            forceTLS: true,
        });

        // Listen for the 'MessageSent' event on the specific ticket channel
        echo.channel('ticket.' + ticketId)
            .listen('MessageSent', (event) => {
                // Add the received message to the chat
                addMessage(event.message, false);  // 'false' indicates it's a received message
            });
    </script>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
