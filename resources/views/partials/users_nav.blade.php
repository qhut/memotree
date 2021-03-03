<section style="height: 600px; overflow: scroll;">
    @if(isset($users))
        <ul class="users">
            @foreach($users as $user)
                <li class="user" id="{{$user->id}}">

                    {{--will show unread count notification--}}
                    @if($user->unread)
                        <span class="pending">{{ $user->unread }}</span>
                    @endif

                    <div class="media">
                        <div class="media-left">
                            <img src="" alt="" class="media-object">
                        </div>

                        <div class="media-body" style="font-size: 1.5em;">
                            <i class="fas fa-portrait" title="{{ $user->email}}"></i>
                            {{$user->name}}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</section>