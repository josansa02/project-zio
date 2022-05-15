<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;

class UserController extends Controller
{
    public function show($name)
    {
        $user = User::where(['name' => $name])->get()->first();
        $imagenes = Image::where(['user_id' => $user->id])->get();
        return view("galeria", compact('imagenes' ,'user'));
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