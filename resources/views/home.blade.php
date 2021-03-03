@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <p style="text-align: center; padding:27px 20px 0px 20px; font-size: 1.2em;background-color: #89cc97">Chat</p>
            @if(isset($messages))
                <div class="col-md-12" id="messages">
                    <div class="message-wrapper">
                        <ul class="messages">
                            @foreach($messages as $message)
                                <li class="message clearfix">
                                    <div class="{{ ($message->from == Auth::id()) ? 'sent' : 'received' }}">
                                        <p>{{ $message->message}}</p>
                                        <p class="date">{{date('d M y, h: i a', strtotime($message->created_at))}}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="input-text">
                        <input type="text" name="message" class="submit">
                    </div>
                </div>
            @else
                <div class="col-md-8" id="messages">

                </div>
            @endif
        </div>
    </div>

@endsection