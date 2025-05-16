<!-- filepath: resources/views/layouts/public-header.blade.php -->
<header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="Clinic Logo" class="h-10 w-10" />
            <div class="text-xl font-bold text-blue-700">Deshet Indigenous Medical Center</div>
        </div>
        <nav class="flex items-center space-x-6">
            <a href="/home" class="text-blue-700 hover:underline transition">Home</a>
            <a href="#about" class="text-blue-700 hover:underline transition">About</a>
            <a href="#blog" class="text-blue-700 hover:underline transition">Blog</a>
            <a href="{{ route('products.public') }}" class="text-blue-700 hover:underline transition">Our Products</a>
            <a href="{{ route('cart.index') }}" class="text-blue-700 hover:underline transition">Cart</a>
            <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Login</a>
        </nav>
    </div>
</header>