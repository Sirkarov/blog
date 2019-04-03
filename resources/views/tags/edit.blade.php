@extends('main')

@section('title',"| Edit Tag")

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{$tag->name}} tag <small>{{$tag->posts()->count()}} Posts</small></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Tags</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tag->posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>
                            @foreach($post->tags as $post_tag)
                                <span class="badge badge-secondary">{{$post_tag->name}}</span>
                            @endforeach
                        </td>
                        <td><a href="{{route('posts.show',$post->id)}}" class="btn btn-sm btn-block btn-default">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <div class="card card-body bg-light">
                <h4 class="text-center">Edit Tag</h4>
                <form method="POST" action="{{route('tags.update',$tag->id)}}">
                    @csrf
                    <input type="hidden" name="_method" value="put" />
                    <div class="form-group">
                        <label for="tag"></label>
                        <input type="text" required value="{{$tag->name}}" class="form-control" name="name" id="tag">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                </form>
            </div>
        </div>

    </div>

@endsection