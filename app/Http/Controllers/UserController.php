<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Message;
use App\Models\Petitions;
use App\Models\Report;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show($name)
    {
        session_start();
        $user = User::where(['name' => $name])->get()->first();
        if ($user) {
            if (!$user->role) {
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
            if ($comparacion === 0 && $user->role == 0) {
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
        
        $user = $id;

        $request->validate([
            'files' => 'required',
            'name' => 'required',
        ]);

        if ($user->profile_img != 'defaultprofileimg.svg') {
            unlink("../public/img/profileIMG/" . $user->profile_img);
        }

        $image_nombre = time() . "-" . $request->name;
        $user->profile_img = $image_nombre;
        $request->file('files')->move("../public/img/profileIMG/", $image_nombre);
        
        $user->update();
        $_SESSION["update"] = "Imagen de perfil actualizada correctamente";
    }

    public function users()
    {
        $users = User::where(['role' => 0])->paginate(5);
        return view('admin/adminUsers', compact('users'));
    }

    public function admins()
    {
        $users = User::where(['role' => 1])->paginate(5);
        return view('admin/admins', compact('users'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->role = true;
        $admin->bio = null;
        $admin->profile_img = null;

        $admin->save();
    }

    public function destroy(User $user)
    {
        if (!$user->role) {
            if ($user->profile_img != 'defaultprofileimg.svg') {
                unlink("../public/img/profileIMG/" . $user->profile_img);
            }
            
            $images = Image::where(['user_id' => $user->id])->get();
            foreach ($images as $image) {
                unlink("../public/img/usersIMG/" . $image->img_name);
            }
            
            $details = [
                'titulo' => 'Su cuenta de ZIO ha sido eliminada',
                'cuerpo' => 'Hola, ' . $user->name . '. Los administradores han decidido eliminar su cuenta de la plataforma.',
            ];
    
            Mail::to($user->email)->send(new SendMail($details));

            $user->delete();
            return redirect()->route('usersAdmin');
        } else {
            $user->delete();
            return redirect()->route('admins');    
        }
    }

    public function changeEnabled(User $user)
    {
        if ($user->enabled) {
            $user->enabled = false;
            Report::where(['owner_id' => $user->id])->delete();
            
            $details = [
                'titulo' => 'Su cuenta de ZIO ha sido vetada permanentemente',
                'cuerpo' => 'Hola, ' . $user->name . '. Por motivos de seguridad, los administradores han decidido vetar su cuenta de la plataforma indefinidamente, para redactar una reclamación acceda a su perfil en la plataforma y envíe una petición de rehabilitación de su cuenta.',
            ];
    
            Mail::to($user->email)->send(new SendMail($details));
        } else {
            $user->enabled = true;
            Petitions::where(['user_id' => $user->id])->delete();

            $details = [
                'titulo' => 'Su cuenta de ZIO ha sido habilitada',
                'cuerpo' => 'Hola, ' . $user->name . '. Los administradores han decidido rehabilitar su cuenta de ZIO, bienvenido de nuevo y tenga cuidado.',
            ];

            Mail::to($user->email)->send(new SendMail($details));
        }

        $user->update();
        
        return redirect()->back();
    }

}
