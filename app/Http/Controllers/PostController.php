<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Post;
use App\Category;
use App\Like;
use App\Dislike;
use App\Comment;

class PostController extends Controller
{
    public function newpost(){
        $categories=Category::all();
        return view('posts.new', ['categories' => $categories]);
    }
    public function addpost(Request $request){
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'featured_image' => 'required'
        ]);

        $post= new Post();
        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category= $request->category;
        if($request->hasFile('featured_image')){
            $imageName= time().'.'.$request->featured_image->extension();
            $request->featured_image->move(public_path('uploads/'),$imageName);
            $post->featured_image=$imageName;
        }
        $post->save();
        return redirect('home')->with('success','Post Published successfully!');
    }  
    public function viewpost($id){
        $post=Post::find($id);
        $categories = Category::all();
        $likescount= Like::where('post_id','=',$id)->get(); 
        $dislikescount= Dislike::where('post_id','=',$id)->get(); 
        $comments= Comment::where('post_id','=',$id)->get(); 
        return view('posts.view',['post'=>$post, 'categories' => $categories,'likescount' => $likescount,'dislikescount' => $dislikescount,'comments' => $comments]);
    }
    public function editpost($id){
        $post=Post::find($id);
        $categories=Category::all();
        return view('posts.edit',['post'=>$post,'categories' => $categories]);
    }
    public function updatepost(Request $request, $id){
        $post=Post::find($id);
        $post->user_id=auth()->user()->id;
        $post->title = $request->title;
        $post->body =$request->body;
        $post->category= $request->category;
        if($request->hasFile('featured_image')){
            $imageName = time().'.'.$request->featured_image->extension();
            $request->featured_image->move(public_path('uploads/'), $imageName);
        }else{
            $imageName = $request['hidden_image'];
        } 

        $post -> save();
        return redirect('home')->with('success','Post updated successfully!');
    }
    public function deletePost($id){
        $user= auth()->user()->id;
        if($user){
            $post = Post::find($id);
            $post->delete();
            return redirect('home')->with('success', 'Post deleted successfully');
        }
    }

    public function approvePost($id){
        $user= auth()->user()->id;
        if($user){
            $post = Post::find($id);
            $post->update(['isApproved' => 1]);
            return redirect('home')->with('success', 'Post Approved successfully');
        }
    }
    public function postlikes($id){
        $user_id=auth()->user()->id;
        $likepost = Like::where('post_id','=',$id)
                    ->where('user_id','=',$user_id)->count();
        if($likepost < 1){
        $like= new Like();
        $like->user_id=$user_id;
        $like->post_id=$id;
        $like->save();
        }
        return redirect()->back(); 
    }
    public function postdislikes($id){
        $user_id=auth()->user()->id;
        $likepost = Dislike::where('post_id','=',$id)
                    ->where('user_id','=',$user_id)->count();
        if($likepost < 1){
        $like= new Dislike();
        $like->user_id=$user_id;
        $like->post_id=$id;
        $like->save();
        }
        return redirect()->back(); 
    }
    public function addComment(Request $request, $id){
        $request->validate([
            'comment' => 'required'
        ]);
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request -> comment;
        $comment->post_id = $id;

        $comment -> save();
        return redirect()->back()->with('success','Comment Added successfully.');
    }
}
