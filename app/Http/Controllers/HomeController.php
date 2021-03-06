<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $all_messages = Message::all();
        $last_message = $all_messages->last();
        $users = DB::select("select users.id, users.name, users.avatar, users.email, count(is_read) as unread
            from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
            where users.id != " . Auth::id() . "
            group by users.id, users.name, users.avatar, users.email");

        if(isset($last_message)) {
            $user_id = $last_message->to;
            //dd($last_message);
            $my_id = Auth::id();

            // Make read all unread message
            Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

            // Get all message from selected user
            $messages = Message::where(function ($query) use ($user_id, $my_id) {
                $query->where('from', $user_id)->where('to', $my_id);
            })->oRwhere(function ($query) use ($user_id, $my_id) {
                $query->where('from', $my_id)->where('to', $user_id);
            })->get();

            if(isset($users) && isset($messages))
            {
                return view('home', ['users' => $users, 'messages' => $messages]);
            }
            if(isset($users))
            {
                return view('home', ['users' => $users, 'messages' => $messages]);
            }
        }
        elseif(isset($users))
        {
            return view('home', ['users' => $users]);
        }else
        {
            return view('home');
        }
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('messages.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;
        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        #$to = intval($to);
        # $from = strval($from);

        $data = ['from' => $from, 'to' => $to];

        $pusher->trigger('my-channel', 'my-event', $data);
    }
}