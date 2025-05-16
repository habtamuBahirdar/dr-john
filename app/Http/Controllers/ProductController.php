<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $products = \App\Models\Product::latest()->get();
    return view('products.index', compact('products'));
}

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    return view('products.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'currency' => 'required|string|max:10',
        'image' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name', 'description', 'price', 'currency']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    \App\Models\Product::create($data);

    return redirect()->route('products.index')->with('success', 'Product added successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $product = \App\Models\Product::findOrFail($id);
    return view('products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $product = \App\Models\Product::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'currency' => 'required|string|max:10',
        'image' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name', 'description', 'price', 'currency']);

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $product = \App\Models\Product::findOrFail($id);
    if ($product->image) {
        \Storage::disk('public')->delete($product->image);
    }
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
}


public function publicIndex()
{
    $products = \App\Models\Product::latest()->paginate(12);
    return view('products.public', compact('products'));
}

public function showPublic($id)
{
    $product = \App\Models\Product::findOrFail($id);
    return view('products.show-public', compact('product'));
}

}
