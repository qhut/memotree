<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;


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
        $users = User::all();

        return view('tasks.create')->with('users', $users);
    }

    public function store(Request $request)
    {
        //dd($request);

        $task = new Task();
        $task->task_subject     = $request->input('task_subject');
        $task->task_description = $request->input('task_description');
        $task->task_comments    = $request->input('task_comments');
        $task->reporter         = Auth::user()->name;;
        $task->assign           = $request->input('assign');
        $task->priority         = $request->input('priority');
        $task->task_progress    = 0;
        $task->deadline         = $request->input('deadline');
        $task->save();

        return redirect('/tasks');
    }

    public function edit($id)
    {
        $task = Task::find($id);
        $users = User::all();
        return view('tasks.edit')->with('task', $task)->with('users', $users);
    }

    public function update(Request $request, $id)
    {

       // dd($request);
        $task = Task::find($id);
        $task->task_subject     = $request->input('task_subject');
        $task->task_description = $request->input('task_description');
        $task->task_comments    = $request->input('task_comments');
        $task->reporter         = $request->input('reporter');
        $task->assign           = $request->input('assign');
        $task->priority         = $request->input('priority');
        $task->task_progress    = $request->input('task_progress');
        $task->deadline         = $request->input('deadline') ?? '';
        $task->save();

        return redirect('tasks')->with('message', 'The task is changed');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('tasks')->with('message', 'The task is deleted');
    }
}
