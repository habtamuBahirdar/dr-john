{{-- filepath: resources/views/blogs/show.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $blog->title }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <p class="text-gray-700 mb-4">{!! $blog->content !!}</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @for ($i = 1; $i <= 5; $i++)
                @if ($blog->{'image_' . $i})
                    <img src="{{ asset('storage/blogs/' . basename($blog->{'image_' . $i})) }}" alt="Blog Image {{ $i }}" class="w-full h-40 object-cover rounded-lg">
                @endif
            @endfor
        </div>
    </div>

    <a href="{{ route('blogs.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded">Back to Blogs</a>
@endsection