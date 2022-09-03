<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class ChatController extends Controller 
{
    
    public $send_sms_endpoint;
    public $send_sms_login_endpoint;
    public $send_sms_check_message_status_endpoint;
    public $send_sms_email_account;
    public $send_sms_account_password;

    public function __construct()
    {
        $this->send_sms_endpoint = Config::get('sms.SMS_PORTAL_SEND_SMS_URL');
        $this->send_sms_login_endpoint = Config::get('sms.SMS_PORTAL_LOGIN_URL');
        $this->send_sms_check_message_status_endpoint =  Config::get('sms.SMS_PORTAL_CONFIRM_SMS_URL');
        $this->send_sms_email_account =  Config::get('sms.SMS_PORTAL_EMAIL');
        $this->send_sms_account_password =  Config::get('sms.SMS_PORTAL_PASSWORD');
        
    }

    public function loginToSMSPortal($email, $password, $end_point)
    {
        $pay_load = array(
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        );

       

        $curl = curl_init();

        // We POST the data
        curl_setopt($curl, CURLOPT_POST, 1);
        // Set the url path we want to call
        curl_setopt($curl, CURLOPT_URL, $end_point);
        // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Insert the data
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pay_load);

        // You can also bunch the above commands into an array if you choose using: curl_setopt_array

        // Send the request
        $result = curl_exec($curl);

        // Get some cURL session information back
        $info = curl_getinfo($curl);
        //  echo 'content type: ' . $info['content_type'] . '<br />';
        // echo 'http code: ' . $info['http_code'] . '<br />';

        // Free up the resources $curl is using
        curl_close($curl);

        return json_decode($result);
    }

    public function checkMessageStatus($message_id, $token)
    {
        $check_message_status_endpoint = $this->send_sms_check_message_status_endpoint;
        $curl = curl_init();

        $data = array(
            'message_id' => (string)$message_id 
        );

        // We POST the data
        curl_setopt($curl, CURLOPT_POST, 1);
        // Set the url path we want to call
        curl_setopt($curl, CURLOPT_URL, $check_message_status_endpoint);
        // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Insert the data
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        curl_setopt($curl, CURLOPT_HTTPHEADER,  array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $token
        ));

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);


        // Free up the resources $curl is using
        curl_close($curl);

        return $result;
    }

   public function phonize($phoneNumber, $country) 
   {

        $countryCodes = array(
            'ug' => '+256',
            'ke' => '+254',
            
        );
    
        return preg_replace('/[^0-9+]/', '',
               preg_replace('/^0/', $countryCodes[$country], $phoneNumber));
    }

    public function sendSMS(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'contact' => 'required|string'
        ]);

        $login_result = $this->loginToSMSPortal($this->send_sms_email_account, $this->send_sms_account_password, $this->send_sms_login_endpoint);

        $token = $login_result->token;

        $contact = $this->phonize($request->contact, "ug");
        
      
        $message =  '*******************' . PHP_EOL . '|    ' . $request->title . '    |' . PHP_EOL . '*******************' . PHP_EOL . $request->message;

       // return $message;
        // Here is the data we will be sending to the service
        $some_data = array(
            'message' => $message,
            'title' => $request->title,
            'contact' => $contact
        );

        $curl = curl_init();
       
        // We POST the data
        curl_setopt($curl, CURLOPT_POST, 1);
        // Set the url path we want to call
        curl_setopt($curl, CURLOPT_URL, $this->send_sms_endpoint);
        // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Insert the data
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($some_data));

        curl_setopt($curl, CURLOPT_HTTPHEADER,  array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $token
        ));
        // Send the request
        $result = curl_exec($curl);
        // Get some cURL session information back
        $info = curl_getinfo($curl);
        // Free up the resources $curl is using
        curl_close($curl);

        $decoded_data = json_decode($result);

        $status = "None";

        if($info['http_code'] == 200)
        {
            $status = $this->checkMessageStatus($decoded_data->message_id, $token);
        }  

        return response()->json([
            'sending_response' => $decoded_data,
            'confirmation_response' => json_decode($status) 
        ]);
    }

    public function showChats(Request $request)
    {
        $chats = Chat::where('created_by', $request->uid)
            ->orWhere('chatting_with', $request->uid)
            ->latest()
            ->get();


        foreach ($chats as $chat) {
            $chat->creator = User::find($chat->created_by);
            $chat->chatter = User::find($chat->chatting_with);

            if ($chat->created_by == $request->uid) {
                $chat->creator = User::find($request->uid);
            }

            if ($chat->chatting_with == $request->uid) {
                $chat->chatter = User::find($request->uid);
            }
        }

        return view('dashboard.pages.chat', ['chats' => $chats]);
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

        if ($chat_one !== null) {
            $chat_messages = ChatMessage::where('chat_id', $chat_one->id)
                ->latest()
                ->paginate(2);
        }

        if ($chat_two !== null) {
            $chat_messages = ChatMessage::where('chat_id', $chat_two->id)
                ->latest()
                ->paginate(2);
        }




        return view(
            'dashboard.pages.user_chat',
            [
                'uid' => $current_user_id,
                'rid' => $receiver_id,
                'chat_messages' => $chat_messages
            ]
        );
    }

    public function saveChatMessage(Request $request)
    {
        $chat_one = Chat::where('created_by', $request->uid)
            ->where('chatting_with', $request->rid)
            ->first();

        $chat_two = Chat::where('created_by', $request->rid)
            ->where('chatting_with', $request->uid)
            ->first();

        if ($chat_one == null && $chat_two == null) {
            // return response()->json("You have no chats with this person!");

            $new_chat = new Chat();
            $new_chat->created_by    = $request->uid;
            $new_chat->chatting_with = $request->rid;
            $new_chat->save();

            $chat_message = new ChatMessage();
            $chat_message->chat_id = $new_chat->id;
            $chat_message->sent_by = $new_chat->created_by;
            $chat_message->message = $request->message;

            if ($chat_message->save()) {
                return response()->json("Message sent!");
            } else {
                return response()->json("Not sent!");
            }
        } else {
            if ($chat_one == null) {

                $chat_message = new ChatMessage();
                $chat_message->chat_id = $chat_two->id;
                $chat_message->sent_by = $request->uid;
                $chat_message->message = $request->message;

                if ($chat_message->save()) {
                    return response()->json("Message sent!");
                } else {
                    return response()->json("Not sent!");
                }
            } else {
                $chat_message = new ChatMessage();
                $chat_message->chat_id = $chat_one->id;
                $chat_message->sent_by = $request->uid;
                $chat_message->message = $request->message;

                if ($chat_message->save()) {
                    return response()->json("Message sent!");
                } else {
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
