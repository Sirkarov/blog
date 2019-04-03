@extends('main')

@section('title',"| $post->title")

@section('content')
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
