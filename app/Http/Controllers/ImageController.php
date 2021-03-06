<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'title' => ['required', 'max:20'],
            'footer' => ['required', 'max:30'],
        ]);

        $image = new Image();
        $image_nombre = time() . "-" . $request->name;
        $image->title = $request->title;
        $image->img_name = $image_nombre;
        $image->footer = $request->footer;
        $image->user_id = Auth::user()->id;
        $image->save();
        $request->file('files')->move("../public/img/usersIMG/", $image_nombre);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //Este m??todo es de PHP pero es la ??nica forma de poder borrar el archivo estando en la carpeta assets
        if (unlink("../public/img/usersIMG/" . $image->img_name)) {
            $image->delete();
            return redirect()->route("gallery", Auth::user()->name);    
        }
    }

    public function destroyImgAdmin(Image $image)
    {
        $user = new User();
        $user = User::find($image->user_id);
        //Este m??todo es de PHP pero es la ??nica forma de poder borrar el archivo estando en la carpeta assets
        if (unlink("../public/img/usersIMG/" . $image->img_name)) {
            $details = [
                'titulo' => 'Su fotograf??a ha sido eliminada',
                'cuerpo' => 'Hola, ' . $user->name . '. Los administradores han decidido eliminar su fotograf??a con t??tulo "' . $image->title . '" de la plataforma dado que ha recibido reportes de otros usuarios, tenga cuidado.',
            ];
            Mail::to($user->email)->send(new SendMail($details));

            $image->delete();
            return redirect()->back();    
        }
    }
}
