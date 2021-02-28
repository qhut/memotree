@extends('layouts.app')

@section('content')
    <style>



        ::selection { background: #5f74a0; color: #fff; }
        ::-moz-selection { background: #5f74a0; color: #fff; }
        ::-webkit-selection { background: #5f74a0; color: #fff; }

        br { display: block; line-height: 1.6em; }

        article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
        ol, ul { list-style: none; }

        input, textarea {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            outline: none;
        }

        blockquote, q { quotes: none; }
        blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
        strong, b { font-weight: bold; }

        table {
            width: 95%;
            border-collapse: collapse;
            border-spacing: 0; }
        img { border: 0; max-width: 100%; }

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
            -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);
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
        <h1>Tasks</h1>
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
    @foreach($tasks as $task)
            <tr>
                <td class="lalign">{{$task->id}}</td>
                <td>{{$task->task_subject}}</td>
                <td>{{$task->task_progress}}</td>
                <td>{{$task->user_id}}</td>
                <td>{{$task->created_at}}</td>
                <td>{{$task->updated_at}}</td>
                <td><a id="btn-edit" class="btn btn-xs btn-primary" href="/tasks/{{ $task->id ?? '' }}/edit"> Edit </a></td>
                <td><a id="btn-show" class="btn btn-xs btn-info" href="/tasks/{{ $task->id ?? '' }}"> Show </a></td>
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