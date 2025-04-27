<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = Message::all();

        return view('message/index', ['messages' => $messages]);
    }
}
