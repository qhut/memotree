@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">

                <div class="container">
                    <h3>Create note</h3>
                    <form method="POST" id="form_node" action="/notes" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="input-group-append">
                                <a id="btn-create"   class="btn btn-xs btn-info" href="/notes"> Back</a>
                                <a id="btn-create"   class="btn btn-xs btn-success" href="/notes/create"> Add New Note</a>
                                <input type="submit" class="btn btn-xs btn-primary" name="commit" value="Create">
                            </div>
                            <br/>
                            <input class="note-input" id="note_name"  name="note_name"     value="{{ $note->name ?? '' }}"     type="text"   placeholder="Note name">
                        </div>
                        <br/>
                        <textarea id="summernote" name="note_content">{{ $note->content ?? '' }}</textarea>
                        <div class="actions">
                            <input name="_method" type="hidden" value="POST" id="input_method">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection