<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = $request->user()->tasks()->with('category');

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by overdue (Pending and due_date < today)
        if ($request->boolean('overdue')) {
            $query->where('status', 'Pending')
                ->whereNotNull('due_date')
                ->where('due_date', '<', today());
        }

        // Paginate results with query string parameters preserved
        $tasks = $query->latest()->paginate(10)->withQueryString();

        // Retrieve user categories for the search bar dropdown
        $categories = $request->user()->categories()->orderBy('name')->get();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $categories = $request->user()->categories()->orderBy('name')->get();

        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $request->user()->tasks()->create($request->validated());

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): View
    {
        abort_if($task->user_id !== auth()->id(), 403);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Task $task): View
    {
        abort_if($task->user_id !== auth()->id(), 403);

        $categories = $request->user()->categories()->orderBy('name')->get();

        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        abort_if($task->user_id !== auth()->id(), 403);

        $task->update($request->validated());

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        abort_if($task->user_id !== auth()->id(), 403);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    /**
     * Mark the specified task as completed.
     */
    public function markCompleted(Task $task): RedirectResponse
    {
        abort_if($task->user_id !== auth()->id(), 403);

        $task->update(['status' => 'Completed']);

        return back()->with('success', 'Task marked as completed.');
    }

    /**
     * Mark the specified task as pending.
     */
    public function markPending(Task $task): RedirectResponse
    {
        abort_if($task->user_id !== auth()->id(), 403);

        $task->update(['status' => 'Pending']);

        return back()->with('success', 'Task marked as pending.');
    }
}
