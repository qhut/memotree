@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <script type="text/javascript">
        $(document).ready(function () {
            document.title = "{{ $task->task_subject ?? 'MemoTree' }}";
        });
    </script>

    <style>
        .description-task-content {
            width: 90%;
            min-height: 500px;
            padding: 2px;
            box-shadow: 1px 1px 2px 5px #d9d9d9;
        }
        h2 {
            padding-left: 20px;
            text-decoration: underline;
        }
        p {
            margin: 10px 10px 10px 10px;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <br/>
            <div class="col-9">
                <div class="container">
                    <div class="form-group">
                        <form method="POST" id="form_node" action="/tasks/{{ $task->id ?? '' }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="">
                                <div class="input-group-append">
                                    <a id="btn-create" class="btn btn-xs btn-info" href="/tasks"> Tasks</a>
                                    <a id="btn-create" class="btn btn-xs btn-success" href="/tasks/create"> Add New Task</a>
                                    <a id="btn-edit" class="btn btn-xs btn-primary" href="/tasks/{{ $task->id ?? '' }}/edit"> Edit </a>
                                    <strong>&nbsp;&nbsp;&nbsp;&nbsp;Reporter:</strong> {{$task->reporter ?? ''}}
                                </div>
                                <br>
                                <div class="input-group-append">
                                    <strong>&nbsp; Assigned:</strong> {{$task->assign ?? ''}}
                                    <strong>&nbsp;&nbsp;&nbsp; Due Date: </strong> {{$task->deadline ?? ''}}
                                    <strong>&nbsp;&nbsp;&nbsp; Priority: </strong>{{$task->priority ?? ''}}
                                    <strong>&nbsp;&nbsp;&nbsp; Progress: &nbsp; </strong>
                                    <progress style="position: absolute; padding: 10px;" value="{{$task->task_progress ?? 0}}" max="100" title="{{$task->task_progress}}%">{{$task->task_progress ?? 0}} </progress>
                                </div>
                            </div>
                            <br>
                            <h2>{{ $task->task_subject ?? '' }}</h2>
                            <br>
                            <div class="description-task-content">
                                {!! $task->task_description ?? '' !!}
                            </div>
                            <br>
                            <br>

                            <div>
                                <strong>Comment: </strong>{{$task->task_comments ?? 'No comment'}}
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection