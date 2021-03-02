@extends('layouts.app')

@section('content')
    <style>
        th{
            background-color: #41586e;
            color: white;
        }
        th, td{
            font-size: 1.3em;
            text-align: center;
            padding: 1%;
        }
    </style>

    <div class="col-xs-12">
        <h1>Tasks</h1>
        <div class="input-group-append">
            <a id="btn-create" class="btn btn-xs btn-success" href="/notes/create"> Add New</a>
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
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Show</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td >{{$task->id}}</td>
                        <td>{{$task->task_subject}}</td>
                        <td>{{$task->task_progress}}</td>
                        <td>{{$task->user_id}}</td>
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