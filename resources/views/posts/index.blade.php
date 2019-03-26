@extends('main')

@section('title','| Posts')

@section('content')
	<div class="row">
		<div class="col-md-10">
			<h3>All Posts Created from <b>{{ Auth::user()->name }}</b></h3>
		</div>
		<div class="col-md-2">
			<a href="{{ route('posts.create') }}" class="btn btn-primary btn-block btn-h1-spacing">Create New Post</a>
		</div>
	</div>
	<hr>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Body</th>
						<th>Created At</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($posts as $post)
						<tr>
							<td>{{$post->id}}</td>
							<td>{{$post->title}}</td>
							<td>{{substr($post->body,0,50)}} {{strlen($post->body) > 50 ? "..." : ""}}</td>
							<td>{{date('M j, Y ',strtotime($post->created_at))}}</td>
							<td><a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">View</a>
								<a href="{{route('posts.edit',$post->id)}}" class="btn btn-danger">Edit</a></td>
						</tr>
						@endforeach
				</tbody>
			</table>
            <div class="row">
                    <div class="mx-auto">
                        {!! $posts->links(); !!}
                    </div>
            </div>
		</div>
	</div>
@endsection
