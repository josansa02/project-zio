<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        session_start();
        if (Auth::user()->enabled) {
            $img = Image::all();
            $images = [];
            foreach ($img as $image) {
                $images[] = [$image, User::select("name", "profile_img")->where(['id' => $image->user_id])->first(), Vote::select()->where(['img_id' => $image->id])->count()];
            }

            if (!isset($_SESSION["nMensajes"])) {
                $_SESSION["nMensajes"] = Message::where(['owner_id' => Auth::user()->id])->count();
            }
            
            return view('home', compact('images'));
        } else {
            return view('peticion');
        }
    }

    public function indexLogin()
    {
        session_start();
        if (Auth::user()->enabled) {
            $img = Image::all();
            $images = [];
            foreach ($img as $image) {
                $images[] = [$image, User::select("name", "profile_img")->where(['id' => $image->user_id])->first()];
            }

            if (!isset($_SESSION["nMensajes"])) {
                $_SESSION["nMensajes"] = Message::where(['owner_id' => Auth::user()->id])->count();
            }
            
            return view('home', compact('images'));
        } else {
            return view('peticion');
        }
    }

    public function ayuda()
    {
        return view('ayuda');
    }
}
