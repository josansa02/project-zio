<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
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
        if (Auth::user()->enabled) {
            $img = Image::all();
            $images = [];
            foreach ($img as $image) {
                $images[] = [$image, User::select("profile_img")->where(['id' => $image->user_id])->first()];
            }
            return view('home', compact('images'));
        } else {
            return view('peticion');
        }
    }

    public function indexLogin()
    {
        if (Auth::user()->enabled) {
            $img = Image::all();
            $images = [];
            foreach ($img as $image) {
                $images[] = [$image, User::select("profile_img")->where(['id' => $image->user_id])->first()];
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
