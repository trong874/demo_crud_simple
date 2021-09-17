<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('category')->orderBy('sort_order','ASC')->get();
        return view('category.test', compact('categories'));
    }

    public function getAll()
    {
        $categories = Category::with('category')->get();
        return response()->json($categories);
    }

    public function create()
    {
        $categories = Category::with('category')->get();
        return view('category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('category.index');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('category.edit', compact('category', 'categories'));
    }


    public function update($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('category.index');
    }

    public function destroyMulti(Request $request)
    {
        $ids = $request->ids;
        Category::whereIn('id', explode(",", $ids))->delete();
    }

    function saveList(Request $list)
    {
       $this->recursive($list->all()['list']);
    }

    public function recursive($list, $parent_id = null, &$sort_order = 0)
    {
        foreach ($list as $item) {
            $sort_order++;
            $category = Category::find($item['id']);
            $category->sort_order = $sort_order;
            $category->parent_id = $parent_id;
            $category->save();
            if (array_key_exists('children',$item)) {
                $this->recursive( $item["children"], $item["id"], $sort_order);
            }
        }
    }

}
