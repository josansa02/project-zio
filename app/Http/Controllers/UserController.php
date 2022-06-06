<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Message;
use App\Models\Report;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

    public function getAll()
    {
        $user = User::all();
        return $user;
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

        $user = $id;
        $request->validate([
            'name' => ['required', Rule::unique('users')->ignore($user->id), 'max:25'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'bio' => ['required', 'max:50']
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->update();

        $_SESSION["update"] = "Perfil actualizado correctamente";
        return redirect()->route('gallery', $user->name);
    }

    public function updateProfileImg(User $id, Request $request)
    {
        session_start();
        return $request;
        // $user = $id;

        // $request->validate([
        //     'files' => 'required',
        //     'name' => 'required',
        // ]);

        // $image_nombre = time() . "-" . $request->name;
        // $user->profileimg = $image_nombre;
        // $request->file('files')->move("../public/img/profileIMG/", $image_nombre);
        
        // $user->update();
        // $_SESSION["update"] = "Perfil actualizado correctamente";
        
        // return redirect()->route('gallery', $user->name);
    }

}
