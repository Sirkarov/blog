@extends('main')

@section('title','| Create New Post')

@section('stylesheets')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

        <div class="row">
            <div class="col-md-8 offset-2">
                <h1>Create New Post</h1>
                <hr>
                <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                   @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="PostTitle" aria-describedby="emailHelp" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="slug">Url</label>
                        <input type="text" class="form-control" name="slug" id="PostSlug" aria-describedby="emailHelp" placeholder="Enter slug">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control" id="category_id" required>
                            <option hidden value="">Choose Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" name="category_id">{{$category->name}}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select name="tags[]" class="form-control select2-multi" id="tags" required multiple="multiple">
                            <option hidden value="">Choose Tags</option>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" name="tag_id">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Upload an Image</label>
                        <input type="file" id="image" name="image" class="form-control block">
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

@section('scripts')
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $('.select2-multi').select2({
            placeholder: "Select Tags"
        });
    </script>
@endsection