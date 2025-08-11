<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $search = $request->input('search');
        $sort = $request->input('sort');
        
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        
        if ($sort === 'high') {
            $query->orderBy('price', 'desc');
        }
        elseif ($sort === 'low') {
            $query->orderBy('price', 'asc');
        }
        
        $products = $query->paginate(6);
        return view('products.index', compact('products' , 'search', 'sort' ));
    }
    
    public function create()
    {
        $seasons = \App\Models\Season::all();
        return view('products.create', compact('seasons'));
    }
    
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        if (isset($data['season'])) {
            $data['season'] = implode(',', $data['season']);
        }
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        
        Product::create($data);
        return redirect()->route('products.index')->with('success', '商品を追加しました。');
    }
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
    
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        
        if (isset($data['season'])) {
            $data['season'] = implode(',', $data['season']);
        }
        
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        
        $product->update($data);
        return redirect()->route('products.index')->with('success', '商品を更新しました。');
    }
    
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', '商品を削除しました。');
    }
}
