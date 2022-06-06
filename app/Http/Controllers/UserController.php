<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Message;
use App\Models\Report;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($name)
    {
        session_start();
        $user = User::where(['name' => $name])->get()->first();
        if ($user) {
            $img = Image::where(['user_id' => $user->id])->get();
            $imagenes = [];
    
            $getReportedImg = Report::select("img_id")->where(['reporter_id' => Auth::user()->id])->get();
            $filterImg = [];
    
            foreach ($getReportedImg as $id) {
                $filterImg[] = $id->img_id;
            }
    
            foreach ($img as $image) {
                if (!in_array($image->id, $filterImg)) {
                    $imagenes[] = [$image, Vote::select()->where(['img_id' => $image->id])->count()];
                }
            }
    
            $nMensajes = Message::where(['owner_id' => Auth::user()->id])->count();
            return view("galeria", compact('imagenes' ,'user', 'nMensajes'));
        } else {
            $_SESSION["userNotFound"] = "Usuario no encontrado";
            return redirect()->back();
        }
    }

    // Función que recoge a todos los usuarios y los filtra por nombre
    public function getAll(Request $request)
    {
        $users = User::all();
        $filtro = $request->q;

        $usersBuscados = [];

        foreach ($users as $user) {
            $comparacion = strpos(strtolower($user->name), strtolower($filtro)); // No distingue entre mayúsculas y minúsculas
            if ($comparacion === 0) {
                $usersBuscados[] = $user;
            }
        }

        return $usersBuscados;
    }

    public function edit(User $id)
    {   
        session_start();
        $user = $id;
        return view('editProfile', compact('user')); 
    }

    public function update(User $id, Request $request)
    {   
        session_start();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'bio' => 'required'
        ]);
        
        $usuarios = User::select("id", "name", "email")->get();
        $error1 = False;
        $error2 = False;
        foreach ($usuarios as $user) {
            if ($user->id != $id->id) {
                if ($user->name == $request->name) {
                    $error1 = True;
                }
                if ($user->email == $request->email) {
                    $error2 = True;
                }          
            }
        }
        if (!$error1 && !$error2) {
            $id->name = $request->name;
            $id->email = $request->email;
            $id->bio = $request->bio;
            $id->update();
            $_SESSION["update"] = "";
            return redirect('galeria/home/'.$id->name);
        } else {
            if (($error1 && $error2)||$error2) {
                $_SESSION["updateError"] = "<div class='error'>Ya existe un usuario registrado que usa ese email.<br>Por favor, inténtelo de nuevo</div>";
            } else {
                $_SESSION["updateError"] = "<div class='error'>Ya existe un usuario que usa ese nombre.<br>Por favor, inténtelo de nuevo</div>";
            }
            return redirect('usuarios/edit/'.$id->id);
        }
    }

    public function updateProfileImg(User $id, Request $request)
    {
        session_start();
        $request->validate([
            'files' => 'required',
            'img' => 'required',
        ]);
        $id->profileimg = $request->img;
        move_uploaded_file($_FILES["files"]["tmp_name"], "c:/xampp/htdocs/Laravel/ProyectoLaravel/public/img/profileIMG/" . $_FILES["files"]["name"]);
        $id->update();
        $_SESSION["update"] = "";
        return redirect('galeria/home/'.$id->name);
    }

}
