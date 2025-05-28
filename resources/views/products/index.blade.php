{{-- filepath: resources/views/products/index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Products</h1>
    <h1>dsgs</h1>
    <a href="{{ route('products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">Add
        Product</a>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-lg shadow-md">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-indigo-600 text-white">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Price</th>
                    <th class="border border-gray-300 px-4 py-2">Currency</th>
                    <th class="border border-gray-300 px-4 py-2">Image</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ Str::limit($product->description, 50) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->price }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->currency }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-24 h-auto max-h-24 mx-auto rounded shadow border" alt="Product Image">
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('products.edit', $product) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
