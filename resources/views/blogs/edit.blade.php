{{-- filepath: resources/views/blogs/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Blog</h1>

    <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold">Title</label>
            <textarea name="title" id="title" class="w-full border-gray-300 rounded-lg" required>{{ $blog->title }}</textarea>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold">Content</label>
            <textarea name="content" id="content" rows="5" class="w-full border-gray-300 rounded-lg" required>{{ $blog->content }}</textarea>
        </div>

        <div class="mb-4">
            <label for="images" class="block text-gray-700 font-bold">Images (up to 5)</label>
            <input type="file" name="images[]" id="images" multiple class="w-full border-gray-300 rounded-lg">
            <p class="text-sm text-gray-500 mt-1">You can upload up to 5 images. Each image must be less than 2MB.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($blog->{'image_' . $i})
                        <img src="{{ asset('storage/' . $blog->{'image_' . $i}) }}" alt="Blog Image {{ $i }}" class="w-full h-40 object-cover rounded-lg">
                    @endif
                @endfor
            </div>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update Blog</button>
    </form>

    {{-- Include CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#title'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection