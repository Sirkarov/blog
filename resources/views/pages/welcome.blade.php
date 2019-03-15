@extends('main')

@section('title', '| Homepage')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="display-4">Welcome to My Blog!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="post">
                    <h3>{{$post->title}}</h3>
                    <p>{{substr($post->body,0,300)}}{{strlen($post->body) > 300 ? "..." : ""}}</p>
                    <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary">Read More</a>
                </div>
            <hr>
            @endforeach
        </div>

            <div class="col-md-3 offset-1">
                <h3>Sidebar</h3>
            </div>
    </div>

</div>

@endsection
