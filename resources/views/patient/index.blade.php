{{-- filepath: resources/views/patient/index.blade.php --}}
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

    {{-- Include Sidebar --}}
    @include('patient.layouts.sidebar')

    {{-- Include Header --}}
    @include('patient.layouts.header')

    {{-- Main Content --}}
    <main class="pt-20 md:pl-64 px-6">
        <h1 class="text-2xl font-semibold text-blue-700 mb-4">Your Health at a Glance</h1>

        {{-- Add Appointment Button --}}
        <div class="mb-6">
            <a href="{{ route('appointments.create') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-green-600">
                Make an Appointment
            </a>
        </div>
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-4">
                {{ session('success') }}
            </div>
        @endif

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