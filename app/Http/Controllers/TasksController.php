<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $tasks = Task::all();
        $users = DB::select("select users.id, users.name, users.avatar, users.email, count(is_read) as unread
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . "
        group by users.id, users.name, users.avatar, users.email");

        return view('tasks.index')->with('tasks', $tasks)->with('users', $users);
    }

    public function show($id)
    {
        $task = Task::find($id);

        return view('tasks.show')->with('task',  $task)->with('title', '');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        return redirect('/tasks');
    }

    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit')->with('title', 'Промяна на категория');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $task = Task::find($id);
        $task->name = $request->input('name');
        $task->save();

        return redirect('tasks')->with('message', 'The task is changed');
    }

    public function destroy($id)
    {
        $task = Tasks::find($id);
        $task->delete();

        return redirect('tasks')->with('message', 'The task is deleted');
    }
}
