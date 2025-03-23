<!-- resources/views/partials/topNav.blade.php -->

<div class="bg-blue-600 text-white shadow-md">
    <div class="max-w-screen-xl mx-auto px-4 py-4 flex justify-end">
        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-300">
                Logout
            </button>
        </form>
    </div>
</div>
