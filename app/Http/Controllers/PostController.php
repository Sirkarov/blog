<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Post;
use Intervention\Image\Facades\Image;
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
        $tags = Tag::all();

        return view('posts.create')->with('categories',$categories)->with('tags',$tags);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'  => 'required',
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

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(300,200)->save($location);

            $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags,false);

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

        $tags = Tag::all();


        return view('posts.edit')->with('post',$post)->with('categories',$categories)->with('tags',$tags);
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


        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time().'.'. $image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(300,200)->save($location);

            $oldFilename = $post->image;

            $post->image = $filename;

            Storage::delete($oldFilename);
        }


        $post->save();

        $post->tags()->sync($request->tags);

        Session::flash('success','The Post was updated Succesfully');

        return redirect()->route('posts.show',$post->id);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->tags()->detach();

        Storage::delete($post->image);

        $post->delete();

        Session::flash('success','The Post was successfully deleted');
        return redirect()->route('posts.index');
    }
}
