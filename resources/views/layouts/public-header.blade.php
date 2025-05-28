<!-- filepath: resources/views/layouts/public-header.blade.php -->
@php
    use Illuminate\Support\Facades\Auth;
@endphp
<header class="bg-white shadow-md sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="Clinic Logo"
                class="h-10 w-10 transition-transform duration-300 hover:scale-110" />
            <div class="text-xl font-bold text-blue-700">Deshet Indigenous Medical Center</div>
        </div>
        <nav x-data="{ open: false }" class="flex items-center space-x-6">
            <div class="hidden md:flex items-center space-x-6">
                <a href="/home" class="text-blue-700 hover:underline hover:text-blue-900 transition">Home</a>
                <a href="#about" class="text-blue-700 hover:underline hover:text-blue-900 transition">About</a>
                <a href="#blog" class="text-blue-700 hover:underline hover:text-blue-900 transition">Blog</a>
                <a href="{{ route('products.public') }}"
                    class="text-blue-700 hover:underline hover:text-blue-900 transition">Our Products</a>
                <a href="{{ route('cart.index') }}"
                    class="relative text-blue-700 hover:underline hover:text-blue-900 transition">
                    Cart
                    @if (session('cart_count', 0) > 0)
                        <span
                            class="absolute -top-2 -right-4 bg-red-500 text-white text-xs rounded-full px-2 py-0.5 animate-bounce">
                            {{ session('cart_count') }}
                        </span>
                    @endif
                </a>
                {{-- Desktop --}}
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Login</a>
                @endif
            </div>
            <!-- Mobile menu button -->
            <button @click="open = !open" class="md:hidden focus:outline-none ml-2">
                <svg x-show="!open" class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <!-- Mobile menu -->
            <div x-show="open" @click.away="open = false"
                class="absolute top-16 right-4 bg-white rounded shadow-lg flex flex-col space-y-2 p-4 w-48 md:hidden animate-fade-in-down z-40">
                <a href="/home" class="text-blue-700 hover:underline transition">Home</a>
                <a href="#about" class="text-blue-700 hover:underline transition">About</a>
                <a href="#blog" class="text-blue-700 hover:underline transition">Blog</a>
                <a href="{{ route('products.public') }}" class="text-blue-700 hover:underline transition">Our
                    Products</a>
                <a href="{{ route('cart.index') }}" class="text-blue-700 hover:underline transition">Cart</a>
                {{-- Mobile --}}
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}" class="inline text-center">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition w-full">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-center">Login</a>
                @endif
            </div>
        </nav>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        .animate-fade-in-down {
            animation: fadeInDown 0.4s;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</header>
