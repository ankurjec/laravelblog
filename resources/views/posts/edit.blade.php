@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Add New Post</h3>
            <form method="POST" action="{{url('updatePost',$post->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="title" name="title" value="{{ $post->title }}" class="form-control" id="title" />
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" rows="5" id="body" />{{$post->body}}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" name="category">
                    <option value="">Select Category</option>
                    @if(!empty($categories))
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$post->category==$category->id ? 'selected="selected"' : ''}}>{{$category->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="featured_image">Upload Image</label>
                <p>
                <img src="{{ asset('uploads/'.$post->featured_image)}}" class="fluid-img"/>
                <input type="hidden" name="hidden_image" value="{{$post->featured_image}}"/>
                </p>
            </div>
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" name="featured_image" class="form-control-file" id="featured_image" />
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection