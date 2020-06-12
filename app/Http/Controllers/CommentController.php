<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Comment;

class CommentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function saveComment(Request $request){

        $validate = $this->validate($request,[
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);

        $user = \Auth::user();

        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //asigno los valores a mi nuevo objeto
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //guardar en la base de datos
        $comment->save();

        return redirect()->route('image.detail',['id'=>$image_id])
                        ->with([
                            'message'=>'Has publicado tu comentario'
                        ]);

    }

    public function deleteComment($id){

        // conseguir datos del usuario identificado
        $user = \Auth::user();

        //conseguir objeto del comentario
        $comment = Comment::find($id);

        //Comprobar si soy el duaño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->id == $user->id)){
            $comment->delete();

            return redirect()->route('image.detail',['id'=>$comment->image->id])
                        ->with([
                            'message'=>'Comentario eliminado'
                        ]);
        }else{

            return redirect()->route('image.detail',['id'=>$comment->image->id])
                        ->with([
                            'message'=>'No tienes los permisos para eliminar este comentario'
                        ]);
        }
    }
    //
}
