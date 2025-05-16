{{-- filepath: resources/views/products/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block font-bold mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" class="w-full border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-bold mb-1">Description</label>
            <textarea name="description" id="description" class="w-full border-gray-300 rounded">{{ $product->description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block font-bold mb-1">Price</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ $product->price }}" class="w-full border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="currency" class="block font-bold mb-1">Currency</label>
            <select name="currency" id="currency" class="w-full border-gray-300 rounded" required>
                <option value="ETB" @if($product->currency == 'ETB') selected @endif>ETB</option>
                <option value="USD" @if($product->currency == 'USD') selected @endif>USD</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block font-bold mb-1">Image</label>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-16 h-16 object-cover mb-2 rounded">
            @endif
            <input type="file" name="image" id="image" class="w-full border-gray-300 rounded">
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update Product</button>
        <a href="{{ route('products.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
@endsection