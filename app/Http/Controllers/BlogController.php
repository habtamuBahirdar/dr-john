<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
    ]);

    $blog = new Blog();
    $blog->title = $request->title;
    $blog->content = $request->content;

    // Handle image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $index => $image) {
            if ($index < 5) { // Limit to 5 images
                $imagePath = $image->store('blogs', 'public'); // Save to 'storage/app/public/blogs'
                $blog->{'image_' . ($index + 1)} = $imagePath; // Save the path to the corresponding column
            }
        }
    }

    $blog->save();

    return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
}



    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

public function update(Request $request, Blog $blog)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $blog->title = $request->title;
    $blog->content = $request->content;

    // Handle image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $index => $image) {
            if ($index < 5) { // Limit to 5 images
                $imagePath = $image->store('blogs', 'public');
                $blog->{'image_' . ($index + 1)} = $imagePath;
            }
        }
    }

    $blog->save();

    return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
}

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }
}