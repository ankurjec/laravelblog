@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{route('addprofile')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="designation" name="designation" value="@if(!empty($profiles->designation)){{ $profiles->designation }} @endif" class="form-control" id="designation" />
            </div>
            @if(!empty($profiles->profile_image))
            <div class="form-group">
                <label for="designation">Uploaded Image</label>
                <input type="hidden" name="uploaded_image" value="{{$profiles->profile_image}}" />
                <img src="{{asset('uploads/profile/'.$profiles->profile_image)}}" class="img-fluid img-thumbnail"/>
            </div>
            @endif
            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" name="profile_image" class="form-control-file" id="profile_image" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection