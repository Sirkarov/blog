@extends('main')

@section('title','| View Post')

@section('content')

    <div class="row">
    	<div class="col-md-8">
    		<h1>{{$post->title}}</h1>
    		<p class="lead">{{$post->body}}</p>
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
    			<div class="col-md-6"><a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary btn-block btn-sm">Edit</a></div>
					<div class="col-md-6"><form role="form" method="POST" action="{{route('posts.destroy', $post->id)}}">
						@csrf
						<input type="hidden" name="_method" value="DELETE">
						<button type="submit" class="btn btn-danger btn-block btn-sm">Delete</button>
						</form></div>
    		</div>
    	</div>
    </div>

@endsection