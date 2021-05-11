<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatMessagesRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\PageResource ;
use App\Models\Chat;
use App\Models\Page;
use App\Notifications\AccountNotification;
use App\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Chat as ChatResource;
use App\Http\Resources\Message as MessageResource;
use Notification;

class ChatController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 400;

    public function index()
    {
        $user = Auth::user();
        if($user -> type_id == 1 ){
            $chats = Chat::where([ 'sender_id' => $user->id ])->get();
        }else{
            $chats = Chat::where([ 'receiver_id' => $user->id ])->get();
        }
        return response()->json(api_response( 1 , '' , ChatResource::collection($chats)), $this-> successStatus);
    }

    public function sendMessage(MessageRequest $request)
    {
        $user = Auth::user();
        $second = User::select('id','type_id','name')->findOrFail($request->receiver_id);
        if( ($user->type_id == 1 && $second->type_id == 1 ) || ($user->type_id == 2 && $second->type_id == 2 ) ){
            $msg = api_msg($request , 'نأسف لا يمكنك المحادثة مع هذا العضو' ,'Sorry, you cannot chat with this member');
            return response()->json(api_response( 0 , $msg ), $this->errorStatus);
        }
        $sender   = ($user->type_id == 1 ) ? $user : $second ;
        $receiver = ($user->type_id == 1 ) ? $second : $user ;
        $notify_ar = "لديك محادثة من " .$user->name;
        $notify_en = 'You have a new Chat from ' .$user->name;
        $msg = api_msg($request , $notify_ar ,$notify_en);
        $chat = Chat::updateOrCreate(['sender_id' => $sender->id , 'receiver_id'=> $receiver->id]);
        Notification::send($receiver, new AccountNotification( $notify_ar , $notify_en ,'chats',$receiver->id));
        $message = $chat->messages()->create([
            'chat_id'   => $chat->id,
            'user_id'   => $user->id,
            'type'      => $user->type_id,
            'content'   => $request->message
        ]);
        return response()->json(api_response( 1 , $msg), $this-> successStatus);
    }

    public function chatMessages(ChatMessagesRequest $request){
        $user = Auth::user();
        $second = User::select('id','type_id','name')->findOrFail($request->receiver_id);
        if( ($user->type_id == 1 && $second->type_id == 1 ) || ($user->type_id == 2 && $second->type_id == 2 ) ){
            $msg = api_msg($request , 'نأسف لا يمكنك المحادثة مع هذا العضو' ,'Sorry, you cannot chat with this member');
            return response()->json(api_response( 0 , $msg ), $this->errorStatus);
        }
        $sender   = ($user->type_id == 1 ) ? $user : $second ;
        $receiver = ($user->type_id == 1 ) ? $second : $user ;
        $chat = Chat::where(['sender_id' => $sender->id , 'receiver_id'=> $receiver->id])->firstOrFail();
        return response()->json(api_response( 1 , '' , MessageResource::collection($chat->messages)), $this-> successStatus);
    }
}
