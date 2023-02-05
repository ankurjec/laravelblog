@extends('layouts.app')
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <!-- <div class="col-md-3 justify-content-center user-profile"> -->
            <!-- @if(!empty($profiles))
                <p><img src="{{asset('uploads/profile/'.$profiles->profile_image)}}" class="img-fluid img-thumbnail"/></p>
                <p>{{ $username }}</p>
                <p>{{ $profiles->designation }}</p>
            @else
                <p><img src="{{asset('uploads/profile/user.png')}}" class="img-fluid img-thumbnail"/></p>
            @endif     -->
        <!-- </div> -->
        <div class="col-md-9">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                   <div class="post-box">
                        <p class="title">{{$post->title}}</p>
                        <p><img src="{{asset('uploads/'.$post->featured_image)}}" class="img-fluid"/></p>
                        <p class="body">{{$post->body}}</p>
                        <p>
                            <a href="{{url('postLikes',$post->id)}}"><i class="fa fa-thumbs-up"></i> Like ({{ $likescount->count() }}) </a>
                            <a href="{{url('postDislikes',$post->id)}}"><i class="fa fa-thumbs-down"></i> Dislike({{ $dislikescount->count() }})</a>
                            <a href="#"><i class="fa fa-comments"></i> Comments( {{$comments->count()}})</a>
                        </p>
                        <div class="comment">
                            <h4>Write your comment ?</h4>
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                           
                            <form method="post" action="{{url('addComment',$post->id)}}">
                            @csrf
                                <div class="form-group">
                                    <textarea name="comment" value="{{ old('comment') }}" class="form-control" rows="5" id="body" placeholder="Write comment here"/></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="comment">
                            <h4>Comments</h4>
                            @foreach($comments as $comment)
                            <div class="comment-box">
                                <p><i class="fa fa-comment"></i > {!! nl2br($comment->comment) !!}</p>
                                <p>Posted by: <i>{{$comment->user->name}}</i></p>
                                <p>Posted date: {{ \Carbon\Carbon::parse($comment->created_at->diffForHumans())->format('j F, Y') }} </p>
                            </div>
                            @endforeach    
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
