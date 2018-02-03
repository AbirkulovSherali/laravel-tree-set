<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Messages;
use App\Events\UserEvent;
use App\Events\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(){
        View::share('link', 'chat');
        $this->middleware('checkAuth');
    }

    public function list(){
        $users = User::where('id', '<>', Auth::user()->id)->get();
        return view('chat/list', [
            'users' => $users
        ]);
    }

    public function chatWith($id){
        $user = User::find($id);
        return view('chat/chat-with', [
            'user' => $user
        ]);
    }

    public function sendMessage(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'text' => 'required',
                'from_user_id' => 'required',
                'to_user_id' => 'required',
            ], [
                'required' => 'Это поле должно быть заполнено!'
            ]);

            $message = Messages::create([
                'from_user_id' => $request->from_user_id,
                'to_user_id' => $request->to_user_id,
                'text' => $request->text,
                'created_at' => $request->created_at
            ]);

            broadcast(new SendMessage($message))->toOthers();
            return '__SUCCESS__';
        }
    }

    public function getMessages(Request $request){
        return Messages::where([
            ['from_user_id', '=', $request->from],
            ['to_user_id', '=', $request->to]
        ])->orWhere([
            ['from_user_id', '=', $request->to],
            ['to_user_id', '=', $request->from]
        ])->get()->toArray();
    }

}
