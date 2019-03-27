@extends('main')

@section('title',' | Categories')

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th>{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="col-lg-4" style="margin-top:40px;">
            <div class="card card-body bg-light">
                <h4 class="text-center">New Category</h4>
                <form method="POST" action="{{route('categories.store')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" required class="form-control" name="name" id="PostCategory" placeholder="Enter Category">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add New Category</button>
                </form>
            </div>
        </div>
    </div>
@stop