<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

   
    public function create()
    {
        return view('admin.categories.create');
    }

   
    public function store(Request $request)
    {
        Category::create([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    
    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        {
            $category->delete();

            return redirect()->route('admin.categories.index');
        }
    }
}
