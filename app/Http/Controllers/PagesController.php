<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Mail;
use Session;

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
    public function postContact(Request $request)
    {

        $validator = Validator::make($request->all(),array(
            'email' => 'required|email|max:255',
            'subject' => 'required|min:3|max:255',
            'message' => 'required|min:10|max:255'
        ));

        if ($validator->fails()) {
            return redirect()->route('getContact')
                ->withErrors($validator)
                ->withInput();
        }

        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        );


       Mail::send('emails.contact',$data,function ($message) use ($data){
        $message->from($data['email']);
        $message->to('test@hotmail.com');
        $message->subject($data['subject']);
       });

       Session::flash('success','The email was sent successfully!');

       return redirect()->route('home');
    }
}
