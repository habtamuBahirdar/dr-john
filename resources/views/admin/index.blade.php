<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('adminBackdrop');

            sidebar.classList.toggle('-translate-x-full');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            document.body.style.overflow = isOpen ? 'hidden' : 'auto';
            backdrop.classList.toggle('hidden', !isOpen);
        }

        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('adminBackdrop');
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
<body class="bg-gray-100 text-gray-800">

    {{-- Backdrop for mobile --}}
    <div id="adminBackdrop" onclick="toggleAdminSidebar()" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>

    {{-- Sidebar --}}
    <div id="adminSidebar" class="fixed top-0 left-0 h-full w-64 bg-indigo-700 text-white p-4 space-y-4 z-50 transform transition-transform duration-300 md:translate-x-0 -translate-x-full">
        <h2 class="text-2xl font-bold mb-6">Admin</h2>
        <nav class="space-y-3">
            <a href="#" class="block hover:bg-indigo-600 px-4 py-2 rounded">Dashboard</a>
            <a href="#" class="block hover:bg-indigo-600 px-4 py-2 rounded">Appointments</a>
            <a href="#" class="block hover:bg-indigo-600 px-4 py-2 rounded">Doctors</a>
            <a href="#" class="block hover:bg-indigo-600 px-4 py-2 rounded">Patients</a>
            <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left hover:bg-indigo-600 px-4 py-2 rounded">
            Logout
        </button>
    </form>
        </nav>
    </div>

    {{-- Header --}}
    <header class="bg-white shadow-md fixed top-0 left-0 w-full md:pl-64 h-16 z-30 flex items-center justify-between px-4">
        <div class="text-indigo-700 font-bold text-xl">Clinic Admin Panel</div>
        <button class="text-indigo-700 text-3xl md:hidden" onclick="toggleAdminSidebar()">☰</button>
    </header>

    {{-- Main Content --}}
    <main class="pt-20 md:pl-64 px-6">
        <h1 class="text-2xl font-semibold text-indigo-800 mb-4">Welcome, Admin!</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Example cards -->
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                <h2 class="text-lg font-bold">Today's Appointments</h2>
                <p class="mt-2 text-gray-700">23 appointments scheduled today.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                <h2 class="text-lg font-bold">Active Doctors</h2>
                <p class="mt-2 text-gray-700">10 doctors online.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
                <h2 class="text-lg font-bold">Pending Approvals</h2>
                <p class="mt-2 text-gray-700">5 new user signups.</p>
            </div>
        </div>
    </main>

</body>
</html>
