<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function fetch()
    {
        return Message::all();
    }

    public function create(Request $request)
    {
        Message::create([
            'text' => $request->text
        ]);
        return $request;
    }

    public function scanner()
    {
        return view('scanner');
    }
}
