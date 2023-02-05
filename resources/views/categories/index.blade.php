@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h3>Add New Category</h3>
            <form method="POST" action="{{route('addCategory')}}" />
            @csrf
            <div class="form-group">
                <label for="category">Name *</label>
                <input type="category" name="name" value="{{ old('name') }}" class="form-control" id="category" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection