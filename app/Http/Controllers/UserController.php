<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {
        //Conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;

        //Validacion de los inputs en views user/config con el metodo post de la carpeta routes/web
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        //Recoger los datos del formulario de la views user/config
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //Asignar nuevos valores al objeto de usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        // Subir la imagen
        $image_path = $request->file('image_path');

        if ($image_path != null) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            $user->image = $image_path_name;
        }

        //Ejecutar consulta y cambios en la base de datos
        $user->update();
        return redirect()->route('user.config')->with(['message' => 'Usuario actualizado correctamente']);
    }

    public function getImage($filename){
        
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($user_id){
        $user = User::find($user_id);

        return view('user.profile',[
            'user'=> $user,
        ]);
    }
}
