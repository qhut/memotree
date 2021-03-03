@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">
            <br/>
            <div class="col-9">
                <div class="container">
                    <h2>Create new task</h2>
                    <div class="form-group">
                    <form method="POST" id="form_node" action="/tasks/{{ $task->id ?? '' }}" accept-charset="UTF-8" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="">
                            <div class="input-group-append">
                                <a id="btn-create"   class="btn btn-xs btn-info" href="/tasks"> Tasks</a>
                                <input type="submit" class="btn btn-xs btn-primary" name="commit" value="Create">
                               <strong> Due Date: </strong> <input type="date" id="birthday" name="deadline"  placeholder="due date" style="height: 25px">
                            </div>
                            <br/>

                            <input class="form-control" id="task_name"  name="task_subject"     value=""     type="text" placeholder="Subject">
                        </div>
                        <br>
                        <select class="form-control" name="assign" id="">
                            <option value="">Select user</option>
                            @if(isset($users))
                                @foreach($users as $user)
                                        <option value={{$user->name}}>{{$user->name}}</option>
                                @endforeach
                            @else
                                <option value="">Kiro</option>
                                <option value="">Gosheto</option>
                                <option value="">Oniq</option>
                                <option value="">Drugiq</option>
                            @endif



                        </select>
                        <br/>

                        <select class="form-control" name="priority" id="">
                            <option value="Low">Low</option>
                            <option value="Middle">Middle</option>
                            <option value="High">High</option>
                            <option value="Immediately">Immediately</option>
                        </select>

                        <textarea id="summernote" name="task_description"></textarea>

                        <input class="form-control" id="task_name"  name="task_comments"     value=""     type="text"   placeholder="comment">

                        <div class="actions">
                            <input name="_method" type="hidden" value="POST" id="input_method">
                        </div>

                        <br>
                    </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection