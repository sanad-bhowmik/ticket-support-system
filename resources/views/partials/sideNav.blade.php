<div x-data="{ open: false }" class="relative">

    <!-- Mobile Hamburger Icon -->
    <div class="md:hidden flex items-center justify-between p-4 bg-blue-800">
        <button @click="open = !open" class="text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Sidebar (Fixed on Desktop, Toggleable on Mobile) -->
    <div :class="open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
         class="fixed inset-y-0 left-0 z-50 md:relative md:translate-x-0 md:w-64 bg-gray-800 text-white h-full transition-transform duration-300 ease-in-out transform shadow-2xl">
        <div class="flex flex-col h-full">
            <!-- Logo/Brand -->
            <div class="flex items-center justify-between p-6 bg-gray-900">
                <h2 class="text-2xl font-semibold">Dashboard</h2>
                <button @click="open = false" class="md:hidden text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Side Navigation Links -->
            <div class="flex-grow overflow-y-auto">
                <ul class="space-y-2 px-4 py-6">
                    <!-- Common Links for All Roles -->
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out
                            {{ Request::routeIs('dashboard') ? 'bg-blue-900' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Home</span>
                        </a>
                    </li>

                    <!-- Links for Role ID 2 -->
                    @if(auth()->user()->role_id == 2)
                        <li>
                            <a href="{{ route('tickets') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out
                                {{ Request::routeIs('tickets') ? 'bg-blue-900' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span>Ticket</span>
                            </a>
                        </li>
                    @endif

                    <!-- Links for Role ID 1 -->
                    @if(auth()->user()->role_id == 1)
                        <li>
                            <a href="{{ route('admin.tickets') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out
                                {{ Request::routeIs('admin.tickets') ? 'bg-blue-900' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span>User Ticket</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('messages.index') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out
                                {{ Request::routeIs('messages.index') ? 'bg-blue-900' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                                <span>User Message's</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Footer (Optional) -->
            <div class="p-4 bg-gray-900 text-center text-sm">
                <p>&copy; Sanad bhowmik</p>
            </div>
        </div>
    </div>

</div>
