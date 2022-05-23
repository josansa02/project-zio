<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

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
        $img = Image::all();
        $images = [];
        foreach ($img as $image) {
            $images[] = [$image, User::select("profile_img")->where(['id' => $image->user_id])->first()];
        }
        return view('home', compact('images'));
    }

    public function indexLogin()
    {
        $images = Image::all();
        return view('home', compact('images'));
    }

    public function ayuda()
    {
        return view('ayuda');
    }
}
