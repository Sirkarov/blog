@extends('main')

@section('title','| View Post')

@section('content')

    <div class="row">
    	<div class="col-md-8">
    		<h1>{{$post->title}}</h1>
    		<p class="lead">{{$post->body}}</p>
			<hr>
			<p class="font-weight-bold">Posted in {{$post->category->name}}</p>

			<hr>
			<div class="tags">
				@foreach($post->tags as $tag)
					<span class="badge badge-secondary">{{$tag->name}}</span>
				@endforeach
			</div>
    	</div>
    	<div class="col-md-4" style="margin-top: 20px">
            <div class="row">
                <div class="col-md-1"><dt>URL:</dt></div>
                <div class="col-md-11 text-right"><dd><a href="{{url("blog/".$post->slug)}}">{{url("blog/".$post->slug)}}</a> </dd></div>
            </div>
			<div class="row">
				<div class="col-md-6"><dt>Category:</dt></div>
				<div class="col-md-6 text-center"><dd>{{$post->category->name}} </dd></div>
			</div>
    		<div class="row">
    			<div class="col-md-6"><dt>Created At:</dt></div>
    			<div class="col-md-6 text-center"><dd>{{date('M j, Y h:ia',strtotime($post->created_at))}}</dd></div>
    		</div>
    		<div class="row">
    			<div class="col-md-6"><dt>Updated At:</dt></div>
    			<div class="col-md-6 text-center"><dd>{{date('M j, Y h:ia',strtotime($post->updated_at))}}</dd></div>
    		</div>
    		<hr>
    			<div class="row">
    			<div class="col-md-6"><a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary btn-block btn-sm">Edit</a></div>
					<div class="col-md-6">
                        <form role="form" method="POST" action="{{route('posts.destroy', $post->id)}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-block btn-sm">Delete</button>
						</form>
                    </div>
    		</div>
    	</div>
    </div>
	<div class="row" style="margin-top:15px">
		<div class="col-md-8">
			@if($post->comments->count()==0)
				<h3>{{$post->comments->count()}} Comments </h3>
				@else
			@if($post->comments->count()>1)
				<h3>{{$post->comments->count()}} Comments </h3>
				@else
				<h3>{{$post->comments->count()}} Comment </h3>
				@endif
			<table class="table">
				<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Comment</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				@foreach($post->comments as $comment)
					<tr>
						<td>{{$comment->name}}</td>
						<td>{{$comment->email}}</td>
						<td>{{$comment->comment}}</td>
						<td>
							<a href="{{route('comments.edit',$comment->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
							<form role="form" action={{route('comments.destroy',$comment->id)}} method="POST">
								@csrf
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
				@endif
		</div>
	</div>

@endsection
