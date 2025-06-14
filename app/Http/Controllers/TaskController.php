<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TaskController extends Controller
{

    public function index(Request $request): View
    {
        $query = Task::where("user_id", Auth::id());

        $sort = $request->input('sort');
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc';

        if ($sort === 'expiration_date') {
            $query->orderBy('expiration_date', $order);
        }

        $tasks = $query->paginate();

        return view('task.index', compact('tasks'))
            ->with('i', ($request->input('page', 1) - 1) * $tasks->perPage())
            ->with('sort', $sort)
            ->with('order', $order);
    }


    public function create(): View
    {
        $task = new Task();

        return view('task.create', compact('task'));
    }


    public function store(TaskRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Task::create($data);
        return Redirect::route('tasks.index')
            ->with('success', 'Task created successfully');
    }


    public function show($id): View
    {
        $task = Task::find($id);

        return view('task.show', compact('task'));
    }

    public function edit($id): View
    {
        $task = Task::find($id);
        if ($task->user_id !== auth()->id()) {
            return view('task.edit', compact('task'))->with('error', 'Not allowed');
        }
        return view('task.edit', compact('task'));
    }


    public function update(TaskRequest $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Not  allowed.');
        }
        $data = $request->validated();
        $data['completed'] = $request->has('completed');
        $task->update($data);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $task = Task::find($id);
        if (!$task || $task->user_id != Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Not allowed.');
        } else {
            $task->delete();
            return Redirect::route('tasks.index')
                ->with('success', 'Task deleted successfully');
        }
    }

    public function toggleComplete(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Not allowed.');
        }
        $task->completed = !$task->completed;
        $task->save();
        return redirect()->route('tasks.index');
    }


}
