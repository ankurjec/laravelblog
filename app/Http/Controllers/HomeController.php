<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $userid=auth()->user()->id;
        $username=auth()->user()->name;
        $profiles=Profile::where('user_id','=',$userid)->first();
        $posts= Post::where('user_id','=',$userid)->paginate(3);
        $categories= Category::all();
        return view('home',['profiles'=> $profiles,'username' => $username ,'posts' => $posts, 'categories' => $categories]);
    }
}
