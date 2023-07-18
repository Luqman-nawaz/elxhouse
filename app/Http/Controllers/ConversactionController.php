<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Chat;
use App\Models\User;
use App\Events\SendMail;
// use App\Mail\MessagesendMail;
use Auth;
use Illuminate\Support\Str;
class ConversactionController extends Controller
{
    //
    public function sendMessage(Request $request){
        $conversaction=Conversation::where('uuid',$request->uuid)->first();
        $user=User::find($conversaction->broker_id);
        $data=['from_name'=>$user->name];
        event(new SendMail($conversaction->customer_id,$data));
        $chat=Chat::create(['user_id'=>Auth::user()->id,'receiver_id'=>$conversaction->customer_id,'conversation_id'=>$conversaction->id,'sender_id'=>Auth::user()->id,'is_read'=>'0','messages'=>$request->message,'uuid'=>$request->uuid]);
    }
    public function customerSendMessage(Request $request){
        $conversaction=Conversation::where('uuid',$request->uuid)->first();
        $user=User::find($conversaction->customer_id);
        $data=['from_name'=>$user->name];
        event(new SendMail($conversaction->broker_id,$data));
        $chat=Chat::create(['user_id'=>Auth::user()->id,'receiver_id'=>$conversaction->broker_id,'conversation_id'=>$conversaction->id,'sender_id'=>Auth::user()->id,'is_read'=>'0','messages'=>$request->message,'uuid'=>$request->uuid]);
    }
    public function receivedMessages(Request $request){
        $conversaction=Conversation::where('uuid',$request->uuid)->first();
        $chat=Chat::where('uuid',$request->uuid)->where('receiver_id',Auth::user()->id)->where('is_read','0')->first();
        if($chat){

            $chat->is_read='1';
            $chat->save();
            return response()->json(['status'=>true,'messages'=>$chat->messages]);
        }else{
            return response()->json(['status'=>false]);
        }
        
    }
}
