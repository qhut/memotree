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
        <h1>Notes</h1>
        <div class="input-group-append">
            <a id="btn-create" class="btn btn-xs btn-success" href="/notes/create"> Add New</a>
        </div>
    <br/>

    <table id="keywords" style="width: 100%" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>Key</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Show</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notes as $note)

            <tr>
                <td class="lalign">{{$note->id}}</td>
                <td>{{$note->name}}</td>
                <td><a id="btn-edit" class="btn btn-xs btn-primary" href="/notes/{{ $note->id ?? '' }}/edit"> Edit </a>
                </td>
                <td><a id="btn-show" class="btn btn-xs btn-info" href="/notes/{{ $note->id ?? '' }}"> Show </a></td>
                <td>
                    <form method="POST" id="form_node" action="/notes/{{ $note->id ?? '' }}" class="form-actions"
                          accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="input-group" style="display:inline-block; vertical-align: middle;">
                            <div class="input-group-append">
                                <input id="btn-delete" class="btn btn-xs btn-danger" type="submit" name="commit"
                                       value="Delete">
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
    <script>
        $(function () {
            $('#keywords').tablesorter();
        });
    </script>
    <script>
        function enter_form(node_id) {
            var nodes_data = {!! json_encode($notes) !!};
            for (var i = 0; i < nodes_data.length; i++) {
                if (node_id == nodes_data[i].id) {
                    $('#form_node').attr('action', '/notes/' + nodes_data[i].id);
                    $('#input_method').val('DELETE');
                    //$('#note_id').val(nodes_data[i].id);
                    $('#note_id').text(nodes_data[i].id);
                    //$('#note_name').val(nodes_data[i].name);
                    $('#note_name').text(nodes_data[i].name);
                    //$('#note_level').val(nodes_data[i].level);
                    $('#note_level').text(nodes_data[i].level);
                    $('#note-content').text('');
                    var noteTxt = nodes_data[i].content;
                    $('#note-content').append($.parseHTML(noteTxt));
                    //$('#summernote').summernote('code', nodes_data[i].content);
                    $('#btn-edit').attr('href', '/notes/' + nodes_data[i].id + '/edit');
                    $('#btn-show').attr('href', '/notes/' + nodes_data[i].id);
                    $('#btn-create').attr('href', '/notes/create');
                }
            }
        }
        $(document).ready(function () {
            $('a.button-vertical-menu').on('click', function (e) {
                e.preventDefault();
                var nn_val = $('input#node_id');
                if (nn_val.val() !== '') {
                    var select_id = "#" + nn_val.val();
                    $(select_id).css('color', '#20c997');
                }
                $(this).css('color', '#FC7753');
                enter_form($(this).attr('id'));
            });
        });
    </script>
@endsection