<?php

namespace App\Http\Controllers;

use App\Models\SharedTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SharedTaskRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SharedTaskController extends Controller
{

    public function index(Request $request): View
    {
        $sharedTaskIds = SharedTask::where('user_id', auth()->id())->pluck('task_id');

        $query = Task::with('user')->whereIn('id', $sharedTaskIds);

        $sort = $request->input('sort');
        $order = $request->input('order') === 'desc' ? 'desc' : 'asc'; // Por defecto asc

        if ($sort === 'expiration_date') {
            $query->orderBy('expiration_date', $order);
        }

        $sharedTasks = $query->paginate();

        return view('shared-task.index', compact('sharedTasks'))
            ->with('i', ($request->input('page', 1) - 1) * $sharedTasks->perPage())
            ->with('sort', $sort)
            ->with('order', $order);
    }

    public function create(): View
    {
        $userTasks = Task::where('user_id', auth()->id())->get();
        $users = User::all();
        $sharedTask = new SharedTask();
        return view('shared-task.create', compact('sharedTask', 'userTasks', 'users'));
    }

    public function store(SharedTaskRequest $request): RedirectResponse
    {
        SharedTask::create($request->validated());

        return Redirect::route('shared-tasks.index')
            ->with('success', 'SharedTask created successfully.');
    }

    public function show($id): View
    {
        $sharedTask = SharedTask::find($id);
        return view('shared-task.show', compact('sharedTask'));
    }


}
