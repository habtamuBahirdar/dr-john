{{-- filepath: resources/views/products/create.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Product</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-bold mb-1">Name</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-bold mb-1">Description</label>
            <textarea name="description" id="description" class="w-full border-gray-300 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block font-bold mb-1">Price</label>
            <input type="number" name="price" id="price" step="0.01" class="w-full border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="currency" class="block font-bold mb-1">Currency</label>
            <select name="currency" id="currency" class="w-full border-gray-300 rounded" required>
                <option value="ETB">ETB</option>
                <option value="USD">USD</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block font-bold mb-1">Image</label>
            <input type="file" name="image" id="image" class="w-full border-gray-300 rounded">
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Add Product</button>
        <a href="{{ route('products.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>

    {{-- Include CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection