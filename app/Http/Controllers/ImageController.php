<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;

class ImageController extends Controller
{
    //Funcion que impide a la pagina acceder a ella si no esta autenticado el usuario
    public function __construct(){
        $this->middleware('auth');
    }

    //Funcion que llama a la vista de la pagina de subir una imagen
    public function createImg(){
        return view('image.create');
    }

    //Funcion que nos permite subir una imagen a la base de datos
    public function saveImg(Request $request)
    {

        $user = \Auth::user();
        $id = $user->id;

        //Validar datos del formulario
        $validate = $this->validate($request, [
            'description' => 'required|',
            'image_path' => 'required|image',
        ]);

        //Recoger datos del formulario
        $image_path = $request->file('image_path');
        $description = $request->input('description');
        
        //Asignar valores al nuevo objeto imagen
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        //Subir fichero y guardar imagen en la carpeta storage/images
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        //Guardar imagen 
        $image->save();
        return redirect()->route('home')->with(['message' => 'La imagen ha sido subida excitosamente']);

    }

    //Obtener la imagen de la carpeta storage/images
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file,200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    
    //
}
