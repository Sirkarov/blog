<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);

        return view('posts.index')->with('posts',$posts);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),array(
            'title' => 'required|max:255',
            'body'  => 'required'
        ));

        if ($validator->fails()) {
            return redirect()->route('posts.create')
                ->withErrors($validator)
                ->withInput();
        }

        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        Session::flash('success','Post was created successfully');

        return redirect()->route('posts.show',$post->id);
    }


    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show')->with('post',$post);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit')->with('post',$post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validator = Validator::make($request->all(),array(
            'title' => 'required|max:255',
            'body'  => 'required'
        ));

        if ($validator->fails()) {
            return redirect()->route('posts.show',$post->id)
                ->withErrors($validator)
                ->withInput();
        }

        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        Session::flash('success','The Post was updated Succesfully');

        return redirect()->route('posts.show',$post->id);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        Session::flash('success','The Post was successfully deleted');
        return redirect()->route('posts.index');
    }
}
