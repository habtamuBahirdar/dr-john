
{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\patient\layouts\app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
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
     @vite('resources/css/app.css')
    {{-- Include Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
        @yield('content')
    </main>

</body>
</html>