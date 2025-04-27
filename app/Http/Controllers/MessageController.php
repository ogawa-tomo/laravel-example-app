<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = Message::all();

        return view('message/index', ['messages' => $messages]);
    }

    public function store(Request $request): RedirectResponse
    {
        $message = new Message();
        $message->body = $request->body;
        $message->save();

        return redirect('/messages');
    }
}
