@extends('main')


@section('title','| Edit Post')

@section('stylesheets')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <form role="form" method="POST" action="{{route('posts.update',$post->id)}}">
        @csrf
        <input type="hidden" name="_method" value="put" />
        <div class="row">
                <div class="col-md-8">

                    <div class="form-group">
                        <label for="PostTitle">Title</label>
                        <input type="text" class="form-control" value="{{$post->title}}" name="title" id="PostTitle" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="PostSlug">Slug</label>
                        <input type="text" class="form-control" value="{{$post->slug}}" name="slug" id="PostSlug" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control" id="category_id" required>
                            <option hidden value="{{$post->category->id}}">{{$post->category->name}}</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" name="category_id">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags:</label>
                        <select id="tags" name="tags[]" multiple="multiple" class="form-control select2-multi">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"{{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? " selected" : "" }}>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>﻿

                    <div class="form-group">
                        <label for="PostBody">Body</label>
                        <textarea type="text" class="form-control" name="body" id="PostBody" rows="5">{{$post->body}}</textarea>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-6"><dt>Created At:</dt></div>
                        <div class="col-md-6"><dd>{{date('M j, Y h:ia',strtotime($post->created_at))}}</dd></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><dt>Updated At:</dt></div>
                        <div class="col-md-6"><dd>{{date('M j, Y h:ia',strtotime($post->updated_at))}}</dd></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6"><a href="{{ route('posts.show',$post->id) }}" class="btn btn-primary btn-block btn-sm">Cancel</a></div>
                        <div class="col-sm-6"><button type="submit" class="btn btn-success btn-sm btn-block">Save Changes</button></div>
                    </div>
                </div>
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection