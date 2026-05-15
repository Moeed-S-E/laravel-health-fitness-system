<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->tasks()->with('category');

        if ($request->category)
            $query->where('category_id', $request->category);
        if ($request->status)
            $query->where('status', $request->status);
        if ($request->priority)
            $query->where('priority', $request->priority);

        $tasks      = $query->orderBy('due_date')->paginate(10);
        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'priority'    => 'required|in:low,medium,high',
            'start_date'  => 'required|date',
            'due_date'    => 'required|date|after_or_equal:start_date',
        ]);

        $data['user_id'] = auth()->id();
        $data['status']  = 'pending';

        Task::create($data);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task created successfully!');
    }

    public function show(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'priority'    => 'required|in:low,medium,high',
            'status'      => 'required|in:pending,in-progress,completed',
            'start_date'  => 'required|date',
            'due_date'    => 'required|date|after_or_equal:start_date',
        ]);

        if ($data['status'] === 'completed' && $task->status !== 'completed') {
            $data['completed_at'] = now();
        }

        $task->update($data);

        return redirect()->route('tasks.show', $task)
                         ->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully!');
    }

    public function complete(Task $task)
    {
        $this->authorizeTask($task);
        $task->update([
            'status'       => 'completed',
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Task marked as completed!');
    }

    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
    }
}