@extends('layouts.app')

@section('content')
    <style>
        th{
            background-color: #41586e;
            color: white;
        }
        th, td{
            font-size: 1em;
            text-align: center;
            padding: 1%;
        }
    </style>

    <div class="col-xs-12">
        <h1>Tasks</h1>
        <div class="input-group-append">
            <a id="btn-create" class="btn btn-xs btn-success" href="/tasks/create"> Add New Task</a>
        </div>
        <br>

        <table id="keywords" style="width: 100%" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Name</th>
                    <th>Reporter</th>
                    <th>Assigned</th>
                    <th>Priority</th>
                    <th>Task Progress</th>
                    <th>Due date</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td >{{$task->id}}</td>
                        <td>{{$task->task_subject}}</td>
                        <td>{{$task->reporter}}</td>
                        <td>{{$task->assign}}</td>
                        <td>{{$task->priority}}</td>
                        <td>
                            <progress style="width: 70%" id="file" value="{{$task->task_progress}}" max="100"  title="{{$task->task_progress}}%">{{$task->task_progress}} </progress>
                        </td>
                        <td>{{$task->deadline ?? "None"}}</td>
                        <td>{{$task->created_at}}</td>
                        <td>{{$task->updated_at}}</td>

                        <td>
                            <a id="btn-edit" class="btn btn-xs btn-primary" href="/tasks/{{ $task->id ?? '' }}/edit"> Edit </a>
                        </td>
                        <td>
                            <a id="btn-show" class="btn btn-xs btn-info" href="/tasks/{{ $task->id ?? '' }}"> Show </a>
                        </td>
                        <td>
                            <form method="POST" id="form_node" action="/tasks/{{ $task->id ?? '' }}" class="form-actions" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="input-group" style="display:inline-block; vertical-align: middle;">
                                    <div class="input-group-append">
                                        <input id="btn-delete" class="btn btn-xs btn-danger" type="submit" name="commit" value="Delete">
                                    </div>
                                </div>
                                <input name="_method" type="hidden" value="DELETE" id="input_method">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection