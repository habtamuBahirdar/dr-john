<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer>
        function togglePatientSidebar() {
            const sidebar = document.getElementById('patientSidebar');
            const backdrop = document.getElementById('patientBackdrop');

            sidebar.classList.toggle('-translate-x-full');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            document.body.style.overflow = isOpen ? 'hidden' : 'auto';
            backdrop.classList.toggle('hidden', !isOpen);
        }

        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('patientSidebar');
            const backdrop = document.getElementById('patientBackdrop');
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

    {{-- Backdrop for mobile --}}
    <div id="patientBackdrop" onclick="togglePatientSidebar()" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>

    {{-- Sidebar --}}
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

    {{-- Header --}}
    <header class="bg-white shadow-md fixed top-0 left-0 w-full md:pl-64 h-16 z-30 flex items-center justify-between px-4">
        <div class="text-blue-600 font-bold text-xl">Welcome, Patient</div>
        <button class="text-blue-600 text-3xl md:hidden" onclick="togglePatientSidebar()">☰</button>
    </header>

    {{-- Main Content --}}
    <main class="pt-20 md:pl-64 px-6">
        <h1 class="text-2xl font-semibold text-blue-700 mb-4">Your Health at a Glance</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-400">
                <h2 class="text-lg font-bold">Upcoming Appointments</h2>
                <p class="mt-2 text-gray-700">You have 2 appointments this week.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-teal-500">
                <h2 class="text-lg font-bold">Assigned Doctor</h2>
                <p class="mt-2 text-gray-700">Dr. Hana Tesfaye (Cardiologist)</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
                <h2 class="text-lg font-bold">Recent Visits</h2>
                <p class="mt-2 text-gray-700">Last seen: May 5, 2025</p>
            </div>
        </div>
    </main>

</body>
</html>
