<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    public function index($id){
        $profiles=Profile::where('user_id','=',$id)->first();
        // return $profiles;exit();
        if(!empty($profiles)){
            return view('profiles.index',['profiles' => $profiles]);
        }
        return view('profiles.index');
    }
    public function addprofile(Request $request){
        $userid=auth()->user()->id;
        $profileData= Profile::where('user_id','=',$userid)->first();
        if(empty($profileData)){
            $designation=$request->designation;
            $imageName = time().'.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('uploads/profile'), $imageName);
            $profile=new Profile();
            $profile->user_id=$userid;
            $profile->designation= $designation;
            $profile->profile_image=$imageName;
            $profile->save();
        }else{
            if($request->hasFile('profile_image')){
                $imageName = time().'.'.$request->profile_image->extension();
                $request->profile_image->move(public_path('uploads/profile'), $imageName);
            }else{
                $imageName = $request['uploaded_image'];
            } 
           $updateData=array(
            'designation' => $request->designation,
            'profile_image' => $imageName
           ); 
           $profile=Profile::where('user_id',$userid)->update($updateData);
        }
        
        return redirect('home')->with('success','Profile Added successfully');
    }
}
