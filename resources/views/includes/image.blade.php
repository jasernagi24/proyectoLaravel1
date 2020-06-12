<div class="card pub-image">
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" alt="" class="avatar" />
                    </div>
                    @endif
                    <div class="data-user">

                        <a class="link-profile" href="{{ route('user.profile',['user_id'=>$image->user->id]) }}">{{$image->user->name." ".$image->user->surname}}
                            <span class="nickname"> {{" | @".$image->user->nick}}</span></a>
                        <a class="btn btn-sm btn-danger imagenDetalle" href="{{ route('image.detail',['id'=>$image->id]) }}">Ir a la publicacion</a>
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
                        <strong>Comentarios ({{count($image->comments)}}) / Likes ({{count($image->likes)}})</strong>
                    </div>
                    <div class="coment-like">

                        <p>{{$image->description}}</p>


                    </div>

                </div>
            </div>