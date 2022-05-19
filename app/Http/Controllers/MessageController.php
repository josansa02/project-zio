<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MessageController extends Controller
{
    public function show(User $user)
    {
        $getMessages = Message::where(['owner_id' => $user->id])->get();
        foreach ($getMessages as $message) {
            $messages[] = [Message::select("message")->where(['id' => $message->id])->get(), User::select("name", "profile_img")->where(['id' => $message->writer_id])->get(), Image::select("name", "title")->where(['id' => $message->img_id])->get()];
        }
        return view('buzonMensajes', compact('messages'));
    }
}
