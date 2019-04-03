<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Session;
use Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $tags = Tag::all();

        return view('tags.index')->with('tags',$tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),array(
            'name' => 'required|min:3|max:255'
        ));

        if ($validator->fails()) {
            return redirect()->route('tags.index')
                ->withErrors($validator)
                ->withInput();
        }

        $tag = new Tag;

        $tag->name = $request->get('name');

        $tag->save();

        Session::flash('success','Tag was created successfully');

        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.show')->with('tag',$tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tag = Tag::findOrFail($id);
        $editTag = Tag::findOrFail($id);
        return view('tags.edit')->with('tag',$tag)->with('editTag',$editTag);
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
            'name' => 'required|min:3|max:255'
        ));

        if ($validator->fails()) {
            return redirect()->route('tags.index')
                ->withErrors($validator)
                ->withInput();
        }

        $tag = Tag::findOrFail($id);

        $tag->name = $request->get('name');

        $tag->save();

        Session::flash('success','Tag was created successfully');

        return redirect()->route('tags.show',$tag->id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        $tag->posts()->detach();
        $tag->delete();

        Session::flash('success','The Tag was successfully deleted');
        return redirect()->route('tags.index');
    }
}
