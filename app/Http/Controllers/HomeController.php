<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Message;
use App\Models\Report;
use App\Models\User;
use App\Models\Vote;
use GuzzleHttp\Psr7\Request;
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
            if (isset($_REQUEST["f"])) {
                if ($_REQUEST["f"] == "up") {
                    $allImg = Image::all();
                    $votosFiltrar = [];
                    $img = [];

                    foreach ($allImg as $image) {
                        $votosFiltrar[] = ['image' => $image, 'votes' => Vote::where(['img_id' => $image->id])->count()];
                    }

                    usort($votosFiltrar, function($a, $b) {
                        return $b['votes'] <=> $a['votes'];
                    });

                    foreach ($votosFiltrar as $image) {
                        $img[] = $image['image'];
                    }
                }
                if ($_REQUEST["f"] == "now") {
                    $img = Image::orderBy('created_at', 'DESC')->get();
                }
                if ($_REQUEST["f"] == "all") {
                    return redirect()->route('home');
                }
            } else {
                $img = Image::all();
            }
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

    public function returnHome()
    {
        return redirect()->route('home');
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
