@extends('layouts.publicLayout')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8 mt-8">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-lg mb-4 w-64 h-64 object-cover mx-auto">
        @endif
        <h1 class="text-2xl font-bold mb-2 text-center">{{ $product->name }}</h1>
        <div class="text-gray-700 mb-4 text-center">{!! $product->description !!}</div>
        <div class="font-bold text-green-700 mb-4 text-center">{{ $product->price }} {{ $product->currency }}</div>
        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="text-center">
            @csrf
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Add to Cart</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('products.public') }}" class="text-blue-600 hover:underline">Back to Products</a>
        </div>
    </div>
@endsection