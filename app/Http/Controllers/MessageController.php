<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function show(User $user)
    {
        
        session_start();
        
        if ($user->id == auth()->user()->id) {
            $i = 1;
            $messages = [];
            $getMessages = Message::where(['owner_id' => $user->id])->get();
            
            if (isset($_SESSION["nMensajes"])) {
                $_SESSION["nMensajes"] = Message::where(['owner_id' => Auth::user()->id])->count();
            }
    
            foreach ($getMessages as $message) {
                $messages[] = [Message::select("id", "message")->where(['id' => $message->id])->first(), User::select("name", "profile_img")->where(['id' => $message->writer_id])->first(), Image::select("id", "img_name", "title")->where(['id' => $message->img_id])->first()];
            }
    
            return view('buzonMensajes', compact('messages', 'i', 'user'));
        } else {
            return redirect()->route('messages', Auth::user());
        }
    
    }

    public function store(Request $request) 
    {
        session_start();
        $message = new Message();
        $message->message = $request->message;
        $message->img_id = $request->img_id;
        $message->owner_id = $request->owner_id;
        $message->writer_id = Auth::user()->id;
        $message->save();

        $_SESSION["message"] = "Mensaje enviado satisfactoriamente";
        if (isset($request->name)) {
            return redirect()->route('gallery', $request->name);
        }
        return redirect()->route('home');
    }

    public function destroy(Message $id)
    {
        session_start();

        $id->delete();
        return redirect()->route('messages', Auth::user());
    }

    public function destroyAll()
    {
        session_start();
       
        Message::where(['owner_id' => Auth::user()->id])->delete();
        return redirect()->route('messages', Auth::user());
    }
}
