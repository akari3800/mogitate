<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;


class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(6);
        return view('products', compact('products'));
    }

    public function search(Request $request) {

        $query = Product::query();

        if($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if($request->get('select-box') === 'price_asc') {
            $query->orderBy('price', 'asc');
        }elseif ($request->get('select-box') === 'price_desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->Paginate(6)->withQueryString();

        return view('search', [
            'products' => $products,
            'keyword' => $request->keyword
        ]);
    }

    public function create() {
        return view('register');
    }

    public function store(RegisterRequest $request) {

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        if ($request->has('season')) {
            $product->seasons()->sync($request->season);
        }

        return redirect()->route('products.index');

        }

    public function show($productId) {
        $product = Product::with('seasons')->findOrFail($productId);

        return view('detail', compact('product'));
    }

    public function update(UpdateRequest $request, $productId) {
        $product = Product::findOrFail($productId);

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        $product->seasons()->sync($request->season);

        return redirect()->route('products.index');

    }

    public function delete($productId) {
        $product =Product::findOrFail($productId);

        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }


}
