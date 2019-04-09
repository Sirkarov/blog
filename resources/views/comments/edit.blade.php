@extends('main')

@section('title',' | Edit Comment')

@section('content')
    <form role="form" method="POST" action="{{route('comments.update',$comment->id)}}">
        @csrf
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="form-group">
                        <label for="name"></label>
                        <input class="form-control" disabled type="text" id="name" name="name" value="{{$comment->name}}">
                </div>
                <div class="form-group">
                    <label for="email"></label>
                    <input class="form-control" disabled type="text" id="email" name="name" value="{{$comment->email}}">
                </div>
                <div class="form-group">
                    <label for="comment"></label>
                    <textarea class="form-control" id="comment" name="comment" rows="5">{{$comment->comment}}</textarea>
                </div>
                <button type="submit" class="btn btn-md btn-success btn-block">Save Changes</button>
            </div>
        </div>
    </form>
@endsection