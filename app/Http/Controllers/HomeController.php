<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use App\Category;
use Illuminate\Support\Str;
use DB;
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
        $email=auth()->user()->email;
        $referred_user_id = auth()->user()->referred_user_id;
// dd( $referred_user_id);
$referred_user_name = DB::table('users')
                        ->where('referral_code', '=', $referred_user_id)
                        ->select('name')
                        ->first();
                        //dd($referred_user_name);
        $referral_code = auth()->user()->referral_code;
        $profiles=Profile::where('user_id','=',$userid)->first();
        $posts= Post::where('user_id','=',$userid)->paginate(3);
        $categories= Category::all();
        return view('home',['referred_user_name' => $referred_user_name,'profiles'=> $profiles,'referred_user_id' => $referred_user_id,'referral_code' => $referral_code,'email' => $email,'username' => $username ,'posts' => $posts, 'categories' => $categories]);
    }

    public function generateRandomString()
    {
       
        $randomString = Str::random(10);
       // dd( $randomString);
        return response()->json($randomString);
    }

    public function save(Request $request)
{
    dd($request);
    $password = $request->input('password');
    // Code to save the password to the database goes here
    return response()->json(['success' => true]);
}
}
