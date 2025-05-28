{{-- filepath: resources/views/cart/index.blade.php --}}
@extends('layouts.publicLayout')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Your Cart</h1>
    @if (count($cart))
        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded shadow mb-6 min-w-[600px]">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach ($products as $product)
                        @php
                            $qty = $cart[$product->id];
                            $total = $qty * $product->price;
                            $grandTotal += $total;
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-16 h-16 object-cover rounded shadow">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 font-semibold">{{ $product->name }}</td>
                            <td class="px-4 py-2">
                                <div class="flex items-center justify-center gap-2">
                                    <form action="{{ route('cart.update', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button name="action" value="minus"
                                            class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition disabled:opacity-50"
                                            {{ $qty <= 1 ? 'disabled' : '' }}>-</button>
                                    </form>
                                    <span class="mx-2 min-w-[24px] text-center">{{ $qty }}</span>
                                    <form action="{{ route('cart.update', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button name="action" value="plus"
                                            class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-4 py-2">{{ $product->price }} {{ $product->currency }}</td>
                            <td class="px-4 py-2">{{ $total }} {{ $product->currency }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right font-bold px-4 py-2">Grand Total:</td>
                        <td class="font-bold px-4 py-2">{{ $grandTotal }} {{ $products->first()->currency ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="max-w-md mx-auto bg-white rounded shadow p-6 mb-6 animate-fade-in-up">
            <form action="{{ route('cart.checkout') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="buyer_name" placeholder="Full Name" required
                    class="border px-3 py-2 rounded w-full focus:ring focus:ring-indigo-200 transition">
                <input type="text" name="buyer_phone" placeholder="Phone Number" required
                    class="border px-3 py-2 rounded w-full focus:ring focus:ring-indigo-200 transition">
                <input type="email" name="buyer_email" placeholder="Email (optional)"
                    class="border px-3 py-2 rounded w-full focus:ring focus:ring-indigo-200 transition">
                <div class="flex flex-col md:flex-row gap-2">
                    <button type="submit" name="payment_method" value="chapa"
                        class="bg-blue-600 text-white px-4 py-2 rounded w-full md:w-auto hover:bg-blue-700 transition">Pay
                        with TeleBirr</button>
                    
                </div>
            </form>
        </div>
    @else
        <div class="text-center text-gray-500 animate-fade-in-up">Your cart is empty.</div>
    @endif

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.7s;
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
