{{-- filepath: resources/views/products/public.blade.php --}}
@extends('layouts.publicLayout')

@section('content')
    {{-- Alpine.js CDN --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <div x-data="{ grid: true }">
        <div class="flex justify-center mb-6 gap-2">
            <button @click="grid = true" :class="grid ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-l focus:outline-none transition">Grid View</button>
            <button @click="grid = false" :class="!grid ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-r focus:outline-none transition">List View</button>
        </div>
        <h1 class="text-3xl font-bold mb-6 text-center animate-fade-in-down">Our Products</h1>
        {{-- Grid View --}}
        <div x-show="grid" class="grid md:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow p-5 flex flex-col items-center transform transition duration-500 hover:scale-105 hover:shadow-xl animate-fade-in-up"
                    x-data="{ added: false, loading: true }">
                    @if ($product->image)
                        <img x-show="!loading" x-transition:enter="transition-opacity duration-700"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="rounded-lg mb-3 w-32 h-32 object-cover shadow" @load="loading = false">
                        <div x-show="loading"
                            class="w-32 h-32 flex items-center justify-center bg-gray-100 rounded-lg mb-3 animate-pulse">
                            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                        </div>
                    @else
                        <div
                            class="w-32 h-32 flex items-center justify-center bg-gray-100 rounded-lg mb-3 text-gray-400 animate-pulse">
                            No Image</div>
                    @endif
                    <h3 class="font-semibold text-lg text-blue-800 mb-2">{{ $product->name }}</h3>
                    <div class="text-gray-600 mb-2 text-center">{!! Str::limit(strip_tags($product->description), 60) !!}</div>
                    <div class="font-bold text-green-700 mb-2">{{ $product->price }} {{ $product->currency }}</div>
                    <div class="flex gap-2">
                        <a href="{{ route('products.public.show', $product->id) }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">View
                            Detail</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST"
                            @submit.prevent="
                                $el.querySelector('button').disabled = true;
                                fetch($el.action, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                                    .then(() => { added = true; setTimeout(() => { added = false; $el.querySelector('button').disabled = false; }, 1200); });
                            ">
                            @csrf
                            <button type="submit"
                                class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105"
                                x-bind:class="{ 'bg-green-600': added }" x-text="added ? 'Added!' : 'Add to Cart'">Add to
                                Cart</button>
                        </form>
                    </div>
                    <template x-if="added">
                        <div class="mt-2 text-green-600 text-sm animate-bounce">Added to cart!</div>
                    </template>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 animate-fade-in-up">No products available.</div>
            @endforelse
        </div>
        {{-- List View --}}
        <div x-show="!grid" class="space-y-4">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow p-4 flex flex-col md:flex-row items-center gap-4 animate-fade-in-up"
                    x-data="{ added: false, loading: true }">
                    @if ($product->image)
                        <img x-show="!loading" x-transition:enter="transition-opacity duration-700"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="rounded-lg w-24 h-24 object-cover shadow" @load="loading = false">
                        <div x-show="loading"
                            class="w-24 h-24 flex items-center justify-center bg-gray-100 rounded-lg animate-pulse">
                            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                        </div>
                    @else
                        <div
                            class="w-24 h-24 flex items-center justify-center bg-gray-100 rounded-lg text-gray-400 animate-pulse">
                            No Image</div>
                    @endif
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg text-blue-800 mb-1">{{ $product->name }}</h3>
                        <div class="text-gray-600 mb-1">{!! Str::limit(strip_tags($product->description), 100) !!}</div>
                        <div class="font-bold text-green-700 mb-1">{{ $product->price }} {{ $product->currency }}</div>
                        <div class="flex gap-2 mt-2">
                            <a href="{{ route('products.public.show', $product->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">View
                                Detail</a>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST"
                                @submit.prevent="
                                    $el.querySelector('button').disabled = true;
                                    fetch($el.action, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                                        .then(() => { added = true; setTimeout(() => { added = false; $el.querySelector('button').disabled = false; }, 1200); });
                                ">
                                @csrf
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105"
                                    x-bind:class="{ 'bg-green-600': added }" x-text="added ? 'Added!' : 'Add to Cart'">Add
                                    to
                                    Cart</button>
                            </form>
                        </div>
                        <template x-if="added">
                            <div class="mt-2 text-green-600 text-sm animate-bounce">Added to cart!</div>
                        </template>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 animate-fade-in-up">No products available.</div>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>

    {{-- Tailwind custom animations --}}
    <style>
        .animate-fade-in-down {
            animation: fadeInDown 0.7s;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.7s;
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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
