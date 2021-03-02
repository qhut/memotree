@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-1">

            </div>

            <div class="col-10">
                <br/>
                <form method="POST" id="form_node" action="/tasks/{{ $task->id ?? '' }}" accept-charset="UTF-8" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="">
                        <div class="input-group-append">
                            <a id="btn-create"   class="btn btn-xs btn-info" href="/tasks"> Back</a>
                            <a id="btn-create"   class="btn btn-xs btn-success" href="/tasks/create"> Add New</a>
                            <a id="btn-show"     class="btn btn-xs btn-info" href="/tasks/{{ $note->id ?? '' }}"> Show </a>
                            <input type="submit" class="btn btn-xs btn-primary" name="commit" value="Update">
                        </div>
                        <br/>

                        <input class="note-input" id="task_name"  name="task_name"     value="{{ $note->name ?? '' }}"     type="text"   placeholder="Note name">
                        <input class="note-input" id="note_level" name="task_level"    value="{{ $note->level ?? '' }}"    type="number" placeholder="Level" >
                        <input class="note-input" id="task_book"  name="task_bookmark" value="{{ $note->bookmark ?? '' }}" type="number" placeholder="Level">
                        <input class="note-input" id="task_id"    name="task_id"       value="{{ $note->id ?? '' }}"       type="number" placeholder="ID">

                    </div>

                    <br/>

                    <textarea id="summernote" name="note_content">{{ $note->content ?? '' }}</textarea>

                    <div class="actions">
                        <input name="_method" type="hidden" value="PUT" id="input_method">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection