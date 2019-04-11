@extends('main')

@section('title',"| $post->title")

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <img alt="image" src="{{asset('images/'. $post->image)}}" height="200" width="400">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2">
            <h1>{{$post->title}}</h1>
            <p>{{$post->body}}</p>
            <hr>
            <p class="font-weight-bold">Posted in {{$post->category->name}}</p>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2">
            @if($post->comments()->count()>1)
            <h3 class="comments-title">{{$post->comments()->count()}} Comments</h3>
            @else
                <h3 class="comments-title">{{$post->comments()->count()}} Comment</h3>
            @endif
            @foreach($post->comments as $comment)
                <div class="comment">
                    <div class="comment-author-info">
                        <img alt="image" src="https://scontent.fskp1-1.fna.fbcdn.net/v/t1.0-9/16508524_10208983371247571_6113657190640071565_n.jpg?_nc_cat=102&_nc_ht=scontent.fskp1-1.fna&oh=add3403abc92d9473ecc83cab28eecb8&oe=5D40B6FC"
                             class="comment-author-image rounded-circle">
                        <div class="comment-author-name">
                            <h4>{{$comment->name}}</h4>
                            <p class="small" style="color:#aaa">{{date('M j, o \a\t H:i a',strtotime($comment->created_at))}}</p>
                        </div>
                    </div>
                    <div class="comment-content">
                        {{$comment->comment}}
                    </div>
                </div>
            @endforeach
            <hr>
        </div>
    </div>
    <div class="row">
            <div class="col-md-8 offset-2">
                <h3 style="margin-top: 15px">Have some comments?</h3>
                <form role="form" method="POST" action="{{route('comments.store',$post->id)}}">
                    @csrf
                    <label for="comment"></label>
                    <textarea class="form-control" name="comment" rows="5" placeholder="Add Some Comment Here"></textarea>
                    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 5px">Add Comment</button>
                </form>
            </div>
    </div>
@endsection
