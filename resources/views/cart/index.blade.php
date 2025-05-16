{{-- filepath: resources/views/cart/index.blade.php --}}
@extends('layouts.publicLayout')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Your Cart</h1>
    @if(count($cart))
        <table class="w-full bg-white rounded shadow mb-6">
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
                @foreach($products as $product)
                    @php
                        $qty = $cart[$product->id];
                        $total = $qty * $product->price;
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td class="px-4 py-2">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="inline">
                                @csrf
                                <button name="action" value="minus" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300" {{ $qty <= 1 ? 'disabled' : '' }}>-</button>
                            </form>
                            <span class="mx-2">{{ $qty }}</span>
                            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="inline">
                                @csrf
                                <button name="action" value="plus" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
                            </form>
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
        {{-- Add this above the Pay button --}}
        <form action="{{ route('cart.checkout') }}" method="POST" class="inline">
            @csrf
            <div class="mb-4">
                <input type="text" name="buyer_name" placeholder="Full Name" required class="border px-3 py-2 rounded w-full mb-2">
                <input type="text" name="buyer_phone" placeholder="Phone Number" required class="border px-3 py-2 rounded w-full mb-2">
                <input type="email" name="buyer_email" placeholder="Email (optional)" class="border px-3 py-2 rounded w-full mb-2">
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Pay</button>
        </form>
    @else
        <div class="text-center text-gray-500">Your cart is empty.</div>
    @endif
@endsection