<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function showChats()
    {
        return view('dashboard.pages.chat');
    }

    public function showChatDetail()
    {
        return view('dashboard.pages.chat_detail');
    }
}
