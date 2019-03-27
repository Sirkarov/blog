<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();

        return view('categories.index')->with('categories',$categories);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),array(
            'name' => 'required|max:255'
        ));

        if ($validator->fails()) {
            return redirect()->route('categories.index')
                ->withErrors($validator)
                ->withInput();
        }

        $category = new Category;

        $category->name = $request->get('name');

        $category->save();

        Session::flash('success','Category was created successfully');

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
