<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($paginate =5)
    {
        $products = Product::paginate($paginate);
        $categories = Category::all();
        return view('products.list', compact('products', 'categories','paginate'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('product.list');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('products.edit', compact('categories', 'product'));
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('product.list');
    }


    public function destroy($id)
    {
        Product::destroy($id);
        return back();
    }
    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        Product::whereIn('id',explode(",",$ids))->delete();
        }

    public function showProductByCategoryId($id,$paginate=5)
    {
        $products = Product::where('category_id', $id)->paginate($paginate);
        $categories = Category::all();
        return view('products.list', compact('products', 'categories','paginate'));
    }

    public function filter(Request $request,$paginate=5)
    {
        $categories = Category::all();
        $q = Product::query();
        if ($request->id) {
            $q->where('id', $request->id);
        }
        if ($request->title) {
            $q->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->category_id && is_numeric($request->category_id)) {
            $q->where('category_id', $request->category_id);
        }
        if ($request->price_from && is_numeric($request->price_from)) {
            $q->where('price', '>=', $request->price_from);
            if ($request->price_to && is_numeric($request->price_to) && $request->price_from <= $request->price_to) {
                $q->where('price', '<=', $request->price_to);
            }
        }
        $products = $q->paginate($paginate);
        $old_data = $request->all();
        return view('products.list', compact('products', 'categories', 'old_data','paginate'));
    }
}
