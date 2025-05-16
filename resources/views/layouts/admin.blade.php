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
    <div id="adminSidebar"
        class="fixed top-0 left-0 h-full w-64 bg-indigo-700 text-white p-4 space-y-4 z-50 transform transition-transform duration-300 md:translate-x-0 -translate-x-full">
        <h2 class="text-2xl font-bold mb-6">Admin</h2>
   <nav class="space-y-3">
    <a href="{{ route('admin.index') }}" class="block hover:bg-indigo-600 px-4 py-2 rounded">Dashboard</a>
    <a href="#" class="block hover:bg-indigo-600 px-4 py-2 rounded">Appointments</a>
    <a href="{{ route('patients.index') }}" class="block hover:bg-indigo-600 px-4 py-2 rounded">Patients</a>
    <a href="{{ route('users.index') }}" class="block hover:bg-indigo-600 px-4 py-2 rounded">Manage Users</a>
    <a href="{{ route('transactions.index') }}" class="block hover:bg-indigo-600 px-4 py-2 rounded">Transactions</a>
    <a href="{{ route('blogs.index') }}" class="block hover:bg-indigo-600 px-4 py-2 rounded">Blog</a>

    {{-- Product Menu with Submenu --}}
    <div class="relative">
        <button type="button" onclick="document.getElementById('productSubMenu').classList.toggle('hidden')" class="w-full text-left block hover:bg-indigo-600 px-4 py-2 rounded flex items-center justify-between">
            Product
            <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div id="productSubMenu" class="ml-4 mt-2 space-y-1 hidden">
            <a href="{{ route('products.index') }}" class="block hover:bg-indigo-600 px-4 py-2 rounded">Products</a>
            <a href="{{ route('orders.index') }}" class="block hover:bg-indigo-600 px-4 py-2 rounded">Orders</a>
            <a href="{{ route('orders.completed') }}" class="block hover:bg-indigo-600 px-4 py-2 rounded">Completed Orders</a>
            <a href="{{ route('orders.pending') }}" class="block hover:bg-indigo-600 px-4 py-2 rounded">Pending Orders</a>
        </div>
    </div>
    {{-- End Product Menu --}}

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left hover:bg-indigo-600 px-4 py-2 rounded">
            Logout
        </button>
    </form>
</nav>
    </div>

    {{-- Header --}}
    <header
        class="bg-white shadow-md fixed top-0 left-0 w-full md:pl-64 h-16 z-30 flex items-center justify-between px-4">
        <div class="text-indigo-700 font-bold text-xl">Clinic Admin Panel</div>
        <div class="flex items-center gap-4">
            <span class="hidden md:inline text-gray-700">Hello, {{ Auth::user()->name }}</span>
            <button class="text-indigo-700 text-3xl md:hidden" onclick="toggleAdminSidebar()">☰</button>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="pt-20 md:pl-64 px-6">
        @yield('content')
    </main>

</body>

</html>
