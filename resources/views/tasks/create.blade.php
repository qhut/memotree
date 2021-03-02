@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">

            <br/>

            <div class="col-9">
                <form method="POST" id="form_node" action="/tasks/{{ $task->id ?? '' }}" accept-charset="UTF-8" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="">
                        <div class="input-group-append">
                            <a id="btn-create"   class="btn btn-xs btn-info" href="/tasks"> Back</a>
                            <a id="btn-create"   class="btn btn-xs btn-success" href="/tasks/create"> Add New</a>
                            <a id="btn-show"     class="btn btn-xs btn-info" href="/tasks/{{ $task->id ?? '' }}"> Show </a>
                            <input type="submit" class="btn btn-xs btn-primary" name="commit" value="Update">
                        </div>
                        <br/>

                        <input class="note-input" id="task_name"  name="task_name"     value=""     type="text"   placeholder="Note name">
                        <input class="note-input" id="note_level" name="task_level"    value=""    type="number" placeholder="Level" >
                        <input class="note-input" id="task_book"  name="task_bookmark" value="" type="number" placeholder="Level">
                        <input class="note-input" id="task_id"    name="task_id"       value=""       type="number" placeholder="ID">

                    </div>
                    <select name="" id="">
                        <option value="">Kiro</option>
                        <option value="">Gosheto</option>
                        <option value="">Oniq</option>
                        <option value="">Drugiq</option>

                       </select>
                    <br/>

                    <textarea id="summernote" name="note_content"></textarea>
                    <input class="note-input" id="task_name"  name="task_name"     value=""     type="text"   placeholder="Note name">
                    <div class="actions">
                        <input name="_method" type="hidden" value="PUT" id="input_method">
                    </div>
                </form>

            </div>
        </div>


    </div>
@endsection