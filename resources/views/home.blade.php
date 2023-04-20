@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
        @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 justify-content-center user-profile">
            <div>
            @if(!empty($profiles))
                <p><img src="{{asset('uploads/profile/'.$profiles->profile_image)}}" class="img-fluid img-thumbnail"/></p>
                <p>{{ $username }}</p>
                <p>{{ $profiles->designation }}</p>
            @else
                <p><img src="{{asset('uploads/profile/user.png')}}" class="img-fluid img-thumbnail"/></p>
            @endif 
            </div>
            @if($referral_code == NULL)
            <button id="botn" onclick="generateRandomPassword ()">Generate Referral Link</button>
            @else
            <h3>Link Already Generated </h3>
            <?php 
           $currentUrl = 'http://127.0.0.1:8000/register';
        //   $token = Str::random(40);
$userId = auth()->user()->id;
$fullUrl = $currentUrl . '/' . $referral_code;

echo $fullUrl;?>
            <!-- echo $currentUrl;?> -->

            @endif 

            <h2 id="password"></h2>



            <div class="categories">
                <h4>Categories</h4>
                <div>
                    <ul class="list-group">
                        @if(!empty($categories))
                            @foreach($categories as $category)
                                <li class="list-group-item">
                                   <a href="{{url('filterCategory',strtolower($category->name))}}">{{$category->name}}</a>
                                </li>
                            @endforeach    
                        @else
                            <li class="list-group-item">Category is not available</li>
                        @endif    
                    </ul>
                </div>
            </div>   
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard
                @if($referred_user_name == NULL)
                <p>You are Not Registered under any user.</p>
                
            @else
                <p>You are  Registered under:{{$referred_user_name->name}} </p>
            @endif 

                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('newCategory') }}"> Add Category</a>
                       
                        <a class="btn btn-success" href="{{ route('newPost') }}"> Add Post</a>
                 
                </div>
            </div>
                <div class="card-body">
                @if(count($posts) > 0)
                   @foreach($posts as $post)
                   <div class="post-box">
                        <p class="title">{{$post->title}}</p>
                        <p><img src="{{asset('uploads/'.$post->featured_image)}}" class="img-fluid" alt="img" style="max-width: 50%;"/></p>
                        <center><p class="body">{{$post->body}}</p></center>
                        <p>
                            <a href="{{ url('/viewPost', $post->id)}}"><i class="fa fa-eye"></i> View</a>
                            @can('isAdmin')
                            <a href="{{url('/editPost', $post->id)}}"><i class="fa fa-edit"></i> Edit</a>
                            <a href="{{url('/deletePost', $post->id)}}" onclick="return confirm('Are you want to delete this post?')"><i class="fa fa-trash"></i> Delete</a>
                            <a href="{{url('/approvePost', $post->id)}}" onclick="return confirm('Are you want to approve this post?')"><i class="fa fa-check"></i> Approve</a>

                            @endcan
                        </p>
                    </div> 
                   @endforeach
                @else
                    Post is not available   
                @endif   
                </div>
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

<script type = text/javascript>
    function generateRandomPassword () {
        
        $.ajax({
            url: '/generate-password',
            success: function (data) {
                $('#password').html(data);
            }
        });
        var element = document.getElementById("botn");
  element.onclick = "";

  function savePassword(password) {
    $.ajax({
        url: '/save-password',
        method: 'POST',
        data: {password: password},
        success: function (data) {
            console.log(data);

            console.log('Password saved successfully');
        },
        error: function (xhr, status, error) {
            console.log('Error saving password:', error);
        }
    });
}
    }
</script>
