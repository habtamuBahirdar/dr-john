<div id="patientSidebar" class="fixed top-0 left-0 h-full w-64 bg-blue-600 text-white p-4 space-y-4 z-50 transform transition-transform duration-300 md:translate-x-0 -translate-x-full">
    <h2 class="text-2xl font-bold mb-6">Patient Panel</h2>
    <nav class="space-y-3">
        <a href="#" class="block hover:bg-blue-500 px-4 py-2 rounded">Dashboard</a>
        <a href="#" class="block hover:bg-blue-500 px-4 py-2 rounded">My Appointments</a>
        <a href="#" class="block hover:bg-blue-500 px-4 py-2 rounded">Schedule Visit</a>
        <a href="#" class="block hover:bg-blue-500 px-4 py-2 rounded">Profile</a>
        
        {{-- Logout (Jetstream-style) --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left hover:bg-blue-500 px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </nav>
</div>