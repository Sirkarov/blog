@extends('main')

@section('title','| Create New Post')

@section('content')

        <div class="row">
            <div class="col-md-8 offset-2">
                <h1>Create New Post</h1>
                <hr>
                <form method="POST" action="{{route('posts.store')}}">
                   @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="PostTitle" aria-describedby="emailHelp" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea type="text" class="form-control" name="body" id="PostBody" placeholder="Enter body for the Post" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Submit Post</button>
                </form>
            </div>
        </div>
@endsection