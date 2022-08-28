<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    public function showChats()
    {
        return view('dashboard.pages.chat');
    }

    public function showChatPage(Request $request)
    {
        $current_user_id = $request->uid;
        $receiver_id = $request->rid;

        $chat_one = Chat::where('created_by', $request->uid)
                     ->where('chatting_with', $request->rid)
                     ->first();

         $chat_two = Chat::where('created_by', $request->rid)
                     ->where('chatting_with', $request->uid)
                     ->first();

        $chat_messages = null;
        
        if($chat_one !== null)
        {
            $chat_messages = ChatMessage::where('chat_id', $chat_one->id)->paginate(2);
        }

        if($chat_two !== null)
        {
            $chat_messages = ChatMessage::where('chat_id', $chat_two->id)->paginate(2);
        }


        

        return view('dashboard.pages.user_chat',
         ['uid' => $current_user_id,
          'rid' => $receiver_id,
          'chat_messages' => $chat_messages]);
    }

    public function saveChatMessage(Request $request)
    {
        $chat_one = Chat::where('created_by', $request->uid)
                     ->where('chatting_with', $request->rid)
                     ->first();

         $chat_two = Chat::where('created_by', $request->rid)
                     ->where('chatting_with', $request->uid)
                     ->first();

        if($chat_one == null && $chat_two == null)
        {
           // return response()->json("You have no chats with this person!");

            $new_chat = new Chat();
            $new_chat->created_by	= $request->uid;
            $new_chat->chatting_with = $request->rid;
            $new_chat->save();

            $chat_message = new ChatMessage();
            $chat_message->chat_id = $new_chat->id;
            $chat_message->sent_by = $new_chat->created_by;
            $chat_message->message = $request->message;

            if($chat_message->save())
            {
                return response()->json("Message sent!");
            }
            else 
            {
                return response()->json("Not sent!");
            }

        }
        else 
        {
            if($chat_one == null)
            {
                
                $chat_message = new ChatMessage();
                $chat_message->chat_id = $chat_two->id;
                $chat_message->sent_by = $request->uid;
                $chat_message->message = $request->message;
    
                if($chat_message->save())
                {
                    return response()->json("Message sent!");
                }
                else 
                {
                    return response()->json("Not sent!");
                }
            }
            else 
            {
                $chat_message = new ChatMessage();
                $chat_message->chat_id = $chat_one->id;
                $chat_message->sent_by = $request->uid;
                $chat_message->message = $request->message;
    
                if($chat_message->save())
                {
                    return response()->json("Message sent!");
                }
                else 
                {
                    return response()->json("Not sent!");
                }
            }

        }

        


        
    }

    public function showChatDetail()
    {
        return view('dashboard.pages.chat_detail');
    }
}
