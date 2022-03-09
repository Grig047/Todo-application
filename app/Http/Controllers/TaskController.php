<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        Task::create($request->all());

        return redirect()->route('home')->with('message', 'Task Created!');
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'status' => $request->status,
        ]);
        return redirect()->route('home')->with('message', 'status updated!');
    }
}
