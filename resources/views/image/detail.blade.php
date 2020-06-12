@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
            <div class="card pub-image">
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" alt="" class="avatar" />
                    </div>
                    @endif
                    <div class="data-user">
                    <a class="link-profile" href="">{{$image->user->name." ".$image->user->surname}}
                            <span class="nickname"> {{" | @".$image->user->nick}}</span></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="image-public">
                        <img src="{{ route('image.public',['filename'=>$image->image_path]) }}" alt="" />
                    </div>
                    <div class="description-public">
                        <span class="nickname">
                            <p style="float: right;">{{\FormatTime::LongTimeFilter($image->created_at)}}</p>
                            <h5>{{"@".$image->user->nick}}</h5>
                        </span>
                        <div class="likes">
                            <?php $user_like = false; ?>
                            @foreach($image->likes as $like)
                                @if($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach
                            @if($user_like)
                                <img src="{{asset('images/like1.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                            @else
                                <img src="{{asset('images/like2.png')}}" data-id="{{$image->id}}" class="btn-like">
                            @endif
                        </div>
                        <p>{{$image->description}}</p>
                        <strong>Comentarios ({{count($image->comments)}}) / Likes ({{count($image->likes)}})</strong>
                    </div>
                    <div class="coment-like">
                        <div class="likes-public">
                            <div class="subir-comentario">
                                <form method="POST" action="{{ route('comment.save')}}" class="">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{$image->id}}">
                                    <textarea name="content" class="form-cotrol" style="border-radius:3px ; margin-left: 4%; width: 79%;"></textarea>
                                    @if($errors->has('content'))
                                    <span class="alert-danger" role="alert">
                                        <strong>{{ $errors->fist('content')}}</strong>
                                    </span>
                                    @endif
                                    <button type="submit" class="btn btn-danger " style=" float: right; width: 15%; padding: 1%; margin: 1%;">Publicar</button>
                                </form>
                            </div>

                        </div>
                        <div>
                            @foreach($image->comments as $comment)
                            <hr>
                            <span style="float: right;">{{\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                <p><h5>{{$comment->user->name}}</h5>
                                    {{$comment->content}}
                                    @if(Auth::check () && ($comment->user_id == Auth::user()->id || $comment->image->id == Auth::user()->id))
                                <a class="btn btn-sm btn-danger" style="float: right;" href="{{route('comment.delete',['id'=>$comment->id])}}">X</a>
                                @endif
                                </p>
                                @endforeach
                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</div>

@endsection