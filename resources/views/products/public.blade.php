{{-- filepath: resources/views/products/public.blade.php --}}
@extends('layouts.publicLayout')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-center">Our Products</h1>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow p-5 flex flex-col items-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-lg mb-3 w-32 h-32 object-cover">
                @else
                    <div class="w-32 h-32 flex items-center justify-center bg-gray-100 rounded-lg mb-3 text-gray-400">No Image</div>
                @endif
                <h3 class="font-semibold text-lg text-blue-800 mb-2">{{ $product->name }}</h3>
                <div class="text-gray-600 mb-2 text-center">{!! Str::limit(strip_tags($product->description), 60) !!}</div>
                <div class="font-bold text-green-700 mb-2">{{ $product->price }} {{ $product->currency }}</div>
                <button type="button" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add to Cart</button>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500">No products available.</div>
        @endforelse
    </div>
    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection