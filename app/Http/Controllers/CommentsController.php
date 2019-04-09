<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $post = Post::findOrfail($id);

        $validator = Validator::make($request->all(),array(
            'comment' => 'required|min:5|max:255',
        ));

        if ($validator->fails()) {
            return redirect()->route('blog.single',$post->slug)
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment;

        $comment->name = Auth::user()->name;
        $comment->email = Auth::user()->email;
        $comment->comment = $request->comment;
        $comment->approved = true;

        $comment->post()->associate($post);

        $comment->save();

        Session::flash('success','Comment was created successfully');

        return redirect()->route('blog.single',$post->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrfail($id);
        return view('comments.edit')->with('comment',$comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),array(
            'comment' => 'required|min:10|max:255'
        ));

        if ($validator->fails()) {
            return redirect()->route('posts.show',$comment->post->id)
                ->withErrors($validator)
                ->withInput();
        }

        $comment = Comment::findOrFail($id);

        $comment->comment = $request->comment;

        $comment->save();

        Session::flash('success','The comment was succesfully updated');

        return redirect()->route('posts.show',$comment->post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrfail($id);

        $comment->delete();

        Session::flash('success','The comment was successfully deleted');

        return redirect()->route('posts.show',$comment->post->id);
    }
}
