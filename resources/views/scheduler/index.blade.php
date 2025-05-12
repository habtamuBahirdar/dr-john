<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scheduler Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer>
        function toggleSchedulerSidebar() {
            const sidebar = document.getElementById('schedulerSidebar');
            const backdrop = document.getElementById('schedulerBackdrop');

            sidebar.classList.toggle('-translate-x-full');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            document.body.style.overflow = isOpen ? 'hidden' : 'auto';
            backdrop.classList.toggle('hidden', !isOpen);
        }

        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('schedulerSidebar');
            const backdrop = document.getElementById('schedulerBackdrop');
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.style.overflow = 'auto';
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Backdrop --}}
    <div id="schedulerBackdrop" onclick="toggleSchedulerSidebar()" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>

    {{-- Sidebar --}}
    <div id="schedulerSidebar" class="fixed top-0 left-0 h-full w-64 bg-green-600 text-white p-4 space-y-4 z-50 transform transition-transform duration-300 md:translate-x-0 -translate-x-full">
        <h2 class="text-2xl font-bold mb-6">Scheduler Panel</h2>
        <nav class="space-y-3">
            <a href="#" class="block hover:bg-green-500 px-4 py-2 rounded">Today's Queue</a>
            <a href="#" class="block hover:bg-green-500 px-4 py-2 rounded">Add Patient to Queue</a>
            <a href="#" class="block hover:bg-green-500 px-4 py-2 rounded">Waiting Room</a>
            <a href="#" class="block hover:bg-green-500 px-4 py-2 rounded">Completed Visits</a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left hover:bg-green-500 px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </nav>
    </div>

    {{-- Header --}}
    <header class="bg-white shadow-md fixed top-0 left-0 w-full md:pl-64 h-16 z-30 flex items-center justify-between px-4">
        <div class="text-green-600 font-bold text-xl">Welcome, Scheduler</div>
        <button class="text-green-600 text-3xl md:hidden" onclick="toggleSchedulerSidebar()">☰</button>
    </header>

    {{-- Main --}}
    <main class="pt-20 md:pl-64 px-6">
        <h1 class="text-2xl font-semibold text-green-700 mb-4">Manage Patient Queues</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-400">
                <h2 class="text-lg font-bold">Patients in Queue</h2>
                <p class="mt-2 text-gray-700">7 patients waiting</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
                <h2 class="text-lg font-bold">Next Appointment</h2>
                <p class="mt-2 text-gray-700">9:30 AM - Amanuel D.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-indigo-500">
                <h2 class="text-lg font-bold">Completed Today</h2>
                <p class="mt-2 text-gray-700">12 patients checked out</p>
            </div>
        </div>
    </main>

</body>
</html>
