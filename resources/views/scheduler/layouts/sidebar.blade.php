{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\scheduler\layouts\sidebar.blade.php --}}
<div id="schedulerSidebar" class="fixed top-0 left-0 h-full w-64 bg-green-600 text-white p-4 space-y-4 z-50 transform transition-transform duration-300 md:translate-x-0 -translate-x-full">
    <h2 class="text-2xl font-bold mb-6">Scheduler Panel</h2>
    <nav class="space-y-3">

        {{-- Schedules Submenu --}}
        <div>
            <button onclick="toggleSubMenu('scheduleSubMenu')" class="w-full flex justify-between items-center hover:bg-green-500 px-4 py-2 rounded">
                <span>Schedules</span>
                <svg class="w-4 h-4 transform transition-transform" id="arrow-scheduleSubMenu" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="scheduleSubMenu" class="ml-4 mt-1 space-y-1 hidden">
                <a href="{{ route('schedules.index') }}" class="block hover:bg-green-500 px-4 py-1 rounded">All Schedules</a>
                <a href="{{ route('schedules.create') }}" class="block hover:bg-green-500 px-4 py-1 rounded">Create Schedule</a>
            </div>
        </div>

        {{-- Today's Queue --}}
        <a href="#" class="block hover:bg-green-500 px-4 py-2 rounded">Today's Queue</a>

        {{-- Add Patient to Queue --}}
        <a href="#" class="block hover:bg-green-500 px-4 py-2 rounded">Add Patient to Queue</a>

        {{-- Visits Submenu --}}
        <div>
            <button onclick="toggleSubMenu('visitSubMenu')" class="w-full flex justify-between items-center hover:bg-green-500 px-4 py-2 rounded">
                <span>Visits</span>
                <svg class="w-4 h-4 transform transition-transform" id="arrow-visitSubMenu" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="visitSubMenu" class="ml-4 mt-1 space-y-1 hidden">
                <a href="#" class="block hover:bg-green-500 px-4 py-1 rounded">Waiting Room</a>
                <a href="#" class="block hover:bg-green-500 px-4 py-1 rounded">Completed Visits</a>
            </div>
        </div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left hover:bg-green-500 px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </nav>
</div>