<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show(User $user)
    {
        $i = 1;
        $messages = [];
        $getMessages = Message::where(['owner_id' => $user->id])->get();
        foreach ($getMessages as $message) {
            $messages[] = [Message::select("message")->where(['id' => $message->id])->first(), User::select("name", "profile_img")->where(['id' => $message->writer_id])->first(), Image::select("id", "img_name", "title")->where(['id' => $message->img_id])->first()];
        }
        return view('buzonMensajes', compact('messages', 'i'));
    }

    public function create(Request $request) 
    {
        Message::create($request->all());
        return redirect("home/");
    }
}
