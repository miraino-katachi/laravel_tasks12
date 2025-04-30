<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\TaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Auth::user()->task()
            ->orderBy('completion_date', 'asc')
            ->orderBy('expiration_date', 'asc')
            ->orderBy('registration_date', 'asc')
            ->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Task $task)
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = new Task();
        $task->fill($request->all());
        // ログインユーザーID
        $task->user_id = Auth::user()->id;
        // 登録日は現在の年月日
        $task->registration_date = date('Y-m-d');
        $task->save();

        return redirect()->route('tasks.show', $task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->checkUserId($task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->checkUserId($task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->checkUserId($task);
        $task->fill($request->all())->save();
        return redirect()->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->checkUserId($task);
        $task->delete();
        return redirect()->route('tasks.index');
    }

    /**
     * ログインユーザーIDとタスクのユーザーIDが異なるときにHttpExceptionをスローする
     *
     * @param Task $task
     * @param integer $status
     * @return void
     */
    public function checkUserId(Task $task, int $status = 404)
    {
        // ログインユーザーIDとタスクのユーザーIDが異なるとき
        if (Auth::user()->id != $task->user_id) {
            // HTTPレスポンスステータスコードを返却
            abort($status);
        }
    }
}
