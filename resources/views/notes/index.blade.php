@extends('layouts.app')

@section('content')
    <style>



        ::selection {
            background: #5f74a0;
            color: #fff;
        }

        ::-moz-selection {
            background: #5f74a0;
            color: #fff;
        }

        ::-webkit-selection {
            background: #5f74a0;
            color: #fff;
        }

        br {
            display: block;
            line-height: 1.6em;
        }

        article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
            display: block;
        }

        ol, ul {
            list-style: none;
        }

        input, textarea {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            outline: none;
        }

        blockquote, q {
            quotes: none;
        }

        blockquote:before, blockquote:after, q:before, q:after {
            content: '';
            content: none;
        }

        strong, b {
            font-weight: bold;
        }

        table {
            width: 95%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        img {
            border: 0;
            max-width: 100%;
        }

        h1 {
            font-family: 'Amarante', Tahoma, sans-serif;
            font-weight: bold;
            font-size: 3.6em;
            line-height: 1.7em;
            margin-bottom: 10px;
            text-align: center;
        }

        /** page structure **/
        #wrapper {
            display: block;
            width: 850px;
            background: #fff;
            margin: 0 auto;
            padding: 10px 17px;
            -webkit-box-shadow: 2px 2px 3px -1px rgba(0, 0, 0, 0.35);
        }

        #keywords {
            margin: 0 auto;
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        #keywords thead {
            cursor: pointer;
            background: #c9dff0;
        }

        #keywords thead tr th {
            font-weight: bold;
            padding: 12px 30px;
            padding-left: 42px;
        }

        #keywords thead tr th span {
            padding-right: 20px;
            background-repeat: no-repeat;
            background-position: 100% 100%;
        }

        #keywords thead tr th.headerSortUp, #keywords thead tr th.headerSortDown {
            background: #acc8dd;
        }

        #keywords thead tr th.headerSortUp span {
            background-image: url('https://i.imgur.com/SP99ZPJ.png');
        }

        #keywords thead tr th.headerSortDown span {
            text-align: center;
            background-image: url('https://i.imgur.com/RkA9MBo.png');
        }

        #keywords tbody tr {
            color: #555;
        }

        #keywords tbody tr td {
            text-align: center;
            padding: 15px 10px;
        }

        #keywords tbody tr td.lalign {
            text-align: left;
        }

    </style>



    <div class="col-xs-12">
        <h1>Notes</h1>
        <div class="input-group-append">
            <a id="btn-create" class="btn btn-xs btn-success" href="/notes/create"> Add New</a>
        </div>

    </div>

    <br/>

    <table id="keywords" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th><span>Key</span></th>
            <th><span>Name</span></th>
            <th><span>Edit</span></th>
            <th><span>Show</span></th>
            <th><span>Delete</span></th>
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