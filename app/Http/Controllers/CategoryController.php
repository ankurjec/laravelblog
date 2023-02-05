<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Profile;

class CategoryController extends Controller
{
    public function index(){
        return view('categories.index');
    }
    public function addcategory(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect('home')->with('success', 'Category Added successfully');
    }
    public function filtercategory($name){
        $category = Category::where('name','=',$name)->first();
        // echo $category;die;
        $posts = Post::where('category','=',$category->id)->paginate(3);
        // return $posts;exit();
        $userid=auth()->user()->id;
        $username=auth()->user()->name;
        $profiles=Profile::where('user_id','=',$userid)->first();
        $categories= Category::all();
        return view('home',['profiles'=> $profiles,'username' => $username ,'posts' => $posts, 'categories' => $categories]);

    }
}
