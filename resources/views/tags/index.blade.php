@extends('main')

@section('title',' | Tags')

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>

                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <th>{{$tag->id}}</th>
                        <td><a href="{{route('tags.show',$tag->id)}}">{{$tag->name}}</a></td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <div class="col-lg-4" style="margin-top:40px;">
            <div class="card card-body bg-light">
                <h4 class="text-center">New Tag</h4>
                <form method="POST" action="{{route('tags.store')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" required class="form-control" name="name" id="PostCategory" placeholder="Enter Tag">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add New Tag</button>
                </form>
            </div>
        </div>
    </div>
@stop