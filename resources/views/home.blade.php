<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deshet Indigenous Medical Center - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            sidebar.classList.toggle('translate-x-full');
        }
    </script>
</head>
<body class="bg-gray-100">

    {{-- NAVBAR --}}
    <header class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Clinic Logo" class="h-10 w-10" />
                <div class="text-xl font-bold text-blue-700">Deshet Indigenous Medical Center</div>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="#" class="text-blue-700 hover:underline">Home</a>
                
                <a href="#" class="text-blue-700 hover:underline">About</a>
                <a href="#" class="text-blue-700 hover:underline">Contact</a>
                <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
            </div>

            <button onclick="toggleSidebar()" class="md:hidden text-blue-700 text-2xl">
                ☰
            </button>
        </div>
    </header>

    {{-- MOBILE SIDEBAR --}}
   <div id="mobileSidebar" class="fixed top-0 right-0 w-64 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="p-4">
            <button onclick="toggleSidebar()" class="text-red-600 text-2xl float-right">&times;</button>
            <h2 class="text-lg font-bold text-blue-700 mt-6">Menu</h2>
            <nav class="mt-4 space-y-2">
                <a href="#" class="block text-blue-600 hover:underline">Home</a>
                <a href="#" class="block text-blue-600 hover:underline">About</a>
                <a href="#" class="block text-blue-600 hover:underline">Contact</a>
                <a href="/login" class="block text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">Login</a>
            </nav>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <main class="pt-20 px-6 text-center">
        <h1 class="text-3xl font-bold text-blue-700 mb-4">Welcome to Our Clinic Scheduling System</h1>
        <p class="text-gray-700 text-lg mb-6">Book your appointments, manage schedules, and get notified online!</p>
        <a href="/register" class="inline-block bg-green-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-green-600">Get Started</a>
    </main>

</body>
</html>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('mobileSidebar');
        sidebar.classList.toggle('translate-x-full');
    }

    // Auto-close sidebar when resizing to desktop
    window.addEventListener('resize', () => {
        const sidebar = document.getElementById('mobileSidebar');
        if (window.innerWidth >= 768) {
            sidebar.classList.add('translate-x-full');
        }
    });
</script>