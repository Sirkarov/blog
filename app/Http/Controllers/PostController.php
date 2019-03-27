<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use Session;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::paginate(10);

        return view('posts.index')->with('posts',$posts);
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create')->with('categories',$categories);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'  => 'required'
        ));

        if ($validator->fails()) {
            return redirect()->route('posts.create')
                ->withErrors($validator)
                ->withInput();
        }

        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
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

        $categories = Category::all();

        return view('posts.edit')->with('post',$post)->with('categories',$categories);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if($post->slug == $request->slug)
        {
            $validator = Validator::make($request->all(),array(
                'title' => 'required|max:255',
                'category_id' => 'required|integer',
                'body'  => 'required'
            ));
        }
        else
        {
            $validator = Validator::make($request->all(),array(
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id' => 'required|integer',
                'body'  => 'required'
            ));
        }

        if ($validator->fails()) {
            return redirect()->route('posts.show',$post->id)
                ->withErrors($validator)
                ->withInput();
        }

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
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
