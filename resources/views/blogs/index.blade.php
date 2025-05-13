{{-- filepath: resources/views/blogs/index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Blogs</h1>
    <a href="{{ route('blogs.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">Add Blog</a>

    <div class="bg-white p-4 rounded-lg shadow-md">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-indigo-600 text-white">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Title</th>
                    <th class="border border-gray-300 px-4 py-2">Content</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $blog->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ Str::limit($blog->content, 50) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('blogs.show', $blog) }}" class="bg-blue-500 text-white px-4 py-2 rounded">View</a>
                                <a href="{{ route('blogs.edit', $blog) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">No blogs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $blogs->links() }}
    </div>
@endsection