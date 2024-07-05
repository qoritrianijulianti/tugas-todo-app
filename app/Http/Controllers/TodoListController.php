<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\TodoCategory;

class TodoListController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')->where('user_id', auth()->id())->get();
        return view('todo.home', compact('todos'));
    }

    public function create()
    {
        $todocategories = TodoCategory::all();
        return view('todo.create', compact('todocategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'todo_category_id' => 'required|exists:todo_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        try {
            Todo::create([
                'todo_category_id' => $request->todo_category_id,
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'status' => false, // default status as not done
            ]);

            return redirect()->route('todo.create')->with('success', 'Todo created successfully.');
        } catch (\Exception $e) {
            \Log::error('Todo creation failed: ' . $e->getMessage());
            return redirect()->route('todo.create')->with('error', 'Failed to create Todo. Please try again.');
        }
    }

    public function edit($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $todocategories = TodoCategory::all();
        return view('todo.edit', compact('todo', 'todocategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'todo_category_id' => 'required|exists:todo_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $todo = Todo::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $todo->update([
            'todo_category_id' => $request->todo_category_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todo.home')->with('success', 'Todo updated successfully.');
    }

    public function destroy($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $todo->delete();

        return redirect()->route('todo.home')->with('success', 'Todo deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $todo = Todo::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $todo->status = $request->status;
        $todo->save();

        return redirect()->route('todo.home')->with('success', 'Todo status updated successfully.');
    }
}
