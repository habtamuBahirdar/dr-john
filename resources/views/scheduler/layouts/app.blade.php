{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\scheduler\layouts\app.blade.php --}}
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

        function toggleSubMenu(id) {
            const menu = document.getElementById(id);
            const arrow = document.getElementById('arrow-' + id);
            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
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

    {{-- Include Sidebar --}}
    @include('scheduler.layouts.sidebar')

    {{-- Include Header --}}
    @include('scheduler.layouts.header')

    {{-- Main Content --}}
    <main class="pt-20 md:pl-64 px-6">
        @yield('content')
    </main>

</body>
</html>