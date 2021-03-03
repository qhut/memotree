@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>
    <style>

    </style>

    <div class="container-fluid">
        <div class="row">
            <br/>
            <div class="col-9">
                <div class="container">
                    <h3>Edit Task</h3>
                    <div class="form-group">
                        <form method="POST" id="form_node" action="/tasks/{{ $task->id ?? '' }}" accept-charset="UTF-8" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="">
                                <div class="input-group-append">
                                    <a id="btn-create"   class="btn btn-xs btn-info" href="/tasks"> Tasks</a>
                                    <a id="btn-create"   class="btn btn-xs btn-success" href="/tasks/create"> Add New</a>
                                    <a id="btn-show"     class="btn btn-xs btn-info" href="/tasks/{{ $task->id ?? '' }}"> Show </a>
                                    <input type="submit" class="btn btn-xs btn-primary" name="commit" value="Update">
                                    <strong> &nbsp;&nbsp;&nbsp; Due Date: </strong>
                                    <input type="hidden" name="reporter" value="{{$task->reporter ?? ''}}"/>
                                    <input type="date" id="birthday" name="deadline"  placeholder="due date" value="{{$task->deadline ?? ''}}" style="height: 25px">
                                    <strong> &nbsp;&nbsp;&nbsp; Change Progress: </strong>
                                    <input type="number" min="0" max="100" step="10" name="task_progress" value="{{$task->task_progress ?? 0}}" id="myPercent"/>

                                </div>
                                <br>
                                <div class="progress" style="width: 23%">
                                    <div class="progress-bar" role="progressbar" style="width:{{$task->task_progress ?? 0}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$task->task_progress ?? 0}}%</div>
                                </div>

                                <input class="form-control" id="task_name"  name="task_subject" value="{{ $task->task_subject ?? '' }}"     type="text" placeholder="Subject">

                            </div>
                            <br>
                            <select class="form-control" name="assign" id="">

                                @if(isset($task->assign))
                                    <option value={{$task->assign}}>{{$task->assign}}</option>
                                    @if(isset($users))
                                        @foreach($users as $user)
                                            <option value={{$user->name}}>{{$user->name}}</option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                            <br/>
                            <select class="form-control" name="priority" id="">
                                @if(isset($task->priority))

                                    @if($task->priority == "Low")
                                        <option value="{{$task->priority}}">{{$task->priority}}</option>
                                        <option value="Middle">Middle</option>
                                        <option value="High">High</option>
                                        <option value="Immediately">Immediately</option>
                                    @elseif($task->priority == "Middle")
                                        <option value="{{$task->priority}}">{{$task->priority}}</option>
                                        <option value="Low">Low</option>
                                        <option value="High">High</option>
                                        <option value="Immediately">Immediately</option>
                                    @elseif($task->priority == "High")
                                        <option value="{{$task->priority}}">{{$task->priority}}</option>
                                        <option value="Low">Low</option>
                                        <option value="Middle">Middle</option>
                                        <option value="Immediately">Immediately</option>
                                    @elseif($task->priority == "Immediately")
                                        <option value="{{$task->priority}}">{{$task->priority}}</option>
                                        <option value="Low">Low</option>
                                        <option value="Middle">Middle</option>
                                        <option value="High">High</option>
                                    @endif
                                @endif
                            </select>
                            <textarea id="summernote" name="task_description">{{$task->task_description ?? ''}}</textarea>

                            <input class="form-control" id="task_name"  name="task_comments"     value="{{$task->task_comments ?? ''}}"     type="text"   placeholder="comment">

                            <div class="actions">
                                <input name="_method" type="hidden" value="PUT" id="input_method">
                            </div>

                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection