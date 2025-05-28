@extends('layouts.publicLayout')

@section('content')
    {{-- Vue.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>
    <div id="product-app" class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8 mt-8">
        <section v-cloak v-if="product">
            <div class="flex justify-center mb-4">
                <img v-show="!loading" :src="product.image" :alt="product.name"
                    class="rounded-lg w-64 h-64 object-cover shadow-lg transition-opacity duration-700"
                    @load="loading = false">
                <div v-show="loading" class="w-64 h-64 flex items-center justify-center bg-gray-100 rounded-lg animate-pulse">
                    <svg class="w-12 h-12 text-gray-300" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                </div>
            </div>
            <header>
                <h1 class="text-2xl font-bold mb-2 text-center animate-fade-in-down">@{{ product.name }}</h1>
            </header>
            <article>
                <div class="text-gray-700 mb-4 text-center animate-fade-in-up" v-html="product.description"></div>
                <div class="font-bold text-green-700 mb-4 text-center animate-fade-in-up">@{{ product.price }}
                    @{{ product.currency }}</div>
            </article>
            <form class="text-center" @submit.prevent="addToCart">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    :class="{ 'bg-green-600': added }">
                    @{{ added ? 'Added!' : 'Add to Cart' }}
                </button>
            </form>
            <div v-if="added" class="mt-4 text-green-600 text-center animate-bounce">
                Product added to cart!
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('products.public') }}"
                    class="text-blue-600 hover:underline transition-colors duration-200">Back to Products</a>
            </div>
        </section>
    </div>

    <script>
        const {
            createApp
        } = Vue;
        createApp({
            data() {
                return {
                    product: {
                        name: @json($product->name),
                        description: @json($product->description),
                        price: @json($product->price),
                        currency: @json($product->currency),
                        image: "{{ $product->image ? asset('storage/' . $product->image) : '' }}"
                    },
                    added: false,
                    loading: true,
                }
            },
            methods: {
                addToCart() {
                    this.added = false;
                    fetch("{{ route('cart.add', $product->id) }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    }).then(() => {
                        this.added = true;
                        setTimeout(() => {
                            this.added = false;
                        }, 1500);
                    });
                }
            }
        }).mount('#product-app');
    </script>

    <style>
        [v-cloak] {
            display: none;
        }

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
