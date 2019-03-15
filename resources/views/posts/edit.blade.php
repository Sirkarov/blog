@extends('main')


@section('title','| Edit Post')

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
