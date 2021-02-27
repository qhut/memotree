@extends('layouts.app')

@section('content')
    <style>html, body {
            height: 100%;
        }
        body {
            margin: 0;
            font-family: sans-serif;
            font-weight: 100;
        }
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
        table {
            width: 800px;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 15px;
            background-color: rgba(255,255,255,0.2);
            color: #fff;
        }
        th {
            text-align: left;
        }
        thead th {
            background-color: #55608f;
        }
        tbody tr:hover {
            background-color: rgba(255,255,255,0.3);
        }
        tbody td {
            position: relative;
        }
        tbody td:hover:before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: -9999px;
            bottom: -9999px;
            background-color: rgba(255,255,255,0.2);
            z-index: -1;
        }
    </style>
    <div class="container">
    <table>
        <thead>
        <tr>
            <th>Task key</th>
            <th>Summary</th>
            <th>Progress</th>
            <th>Assignee</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
    @foreach($tasks as $task)

            <tr>
                <td>KEY:{{$task->id}}</td>
                <td>{{$task->task_subject}}</td>
                <td>{{$task->task_progress}}</td>
                <td>{{$task->user_id}}</td>
                <td>{{$task->created_at}}</td>
                <td>{{$task->updated_at}}</td>

            </tr>


    @endforeach

        </tbody>
    </table>
    </div>
@endsection