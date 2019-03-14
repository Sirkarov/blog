<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    public function getIndex()
    {
        $posts = Post::orderBy('created_at','desc')->limit(5)->get();
        return view('pages.welcome')->with('posts',$posts);
    }
    public function getAbout()
    {
        return view('pages.about');
    }
    public function getContact()
    {
        return view('pages.contact');
    }
}
