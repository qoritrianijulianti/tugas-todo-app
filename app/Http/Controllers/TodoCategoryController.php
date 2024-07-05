<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoCategory;

class TodoCategoryController extends Controller
{
    public function home()
    {
        $categories = TodoCategory::all();
        return view('category.home', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255|unique:todo_categories,category',
        ]);

        TodoCategory::create([
            'user_id' => auth()->id(),
            'category' => $request->category,
        ]);

        return redirect()->route('category.home')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = TodoCategory::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255|unique:todo_categories,category,' . $id,
        ]);

        $category = TodoCategory::findOrFail($id);
        $category->update([
            'category' => $request->category,
        ]);

        return redirect()->route('category.home')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = TodoCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('category.home')->with('success', 'Category deleted successfully.');
    }
}
