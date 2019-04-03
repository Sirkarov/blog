@extends('main')

@section('title',"| $tag->name Tag")

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{$tag->name}} tag - <small>{{$tag->posts()->count()}} posts</small></h1>
        </div>
        <div class="col-md-2">
            <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-sm btn-block btn-primary" style="margin-top: 20px;">Edit</a>
        </div>
        <div class="col-md-2">
            <form role="form" method="POST" action="{{route('tags.destroy',$tag->id)}}">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-sm btn-block btn-danger" style="margin-top: 20px;">Delete</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Tags</th>
                    <th>View Post</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tag->posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>
                            @foreach($post->tags as $tag)
                                <span class="badge badge-secondary">{{$tag->name}}</span>
                            @endforeach
                        </td>
                        <td><a href="{{route('posts.show',$post->id)}}" style="color: white" class="btn btn-sm btn-warning">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection