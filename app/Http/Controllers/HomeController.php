<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Message;
use App\Models\Report;
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
        if (!Auth::user()->role) {
            session_start();
            $img = Image::all();
            $images = [];
            $getReportedImg = Report::select("img_id")->where(['reporter_id' => Auth::user()->id])->get();
            $filterImg = [];
    
            foreach ($getReportedImg as $id) {
                $filterImg[] = $id->img_id;
            }
    
            foreach ($img as $image) {
                if (!in_array($image->id, $filterImg)) {
                    $user = User::where(['id' => $image->user_id])->first();
                    if ($user->enabled) {
                        $images[] = [$image, $user];
                    }
                }
            }
    
            if (!isset($_SESSION["nMensajes"])) {
                $_SESSION["nMensajes"] = Message::where(['owner_id' => Auth::user()->id])->count();
            }
    
            return view('home', compact('images'));
        } else {
            return redirect()->route('usersAdmin');
        }
    }

    public function indexLogin()
    {
        if (!Auth::user()->role) {
            session_start();
            $img = Image::all();
            $images = [];
            $getReportedImg = Report::select("img_id")->where(['reporter_id' => Auth::user()->id])->get();
            $filterImg = [];
    
            foreach ($getReportedImg as $id) {
                $filterImg[] = $id->img_id;
            }
    
            foreach ($img as $image) {
                if (!in_array($image->id, $filterImg)) {
                    $user = User::where(['id' => $image->user_id])->first();
                    if ($user->enabled) {
                        $images[] = [$image, $user];
                    }
                }
            }
    
            if (!isset($_SESSION["nMensajes"])) {
                $_SESSION["nMensajes"] = Message::where(['owner_id' => Auth::user()->id])->count();
            }
    
            return view('home', compact('images'));
        } else {
            return redirect()->route('usersAdmin');
        }
    }

    public function ayuda()
    {
        return view('ayuda');
    }

    public function ayudaAdmin()
    {
        return view('ayudaAdmin');
    }
}
