<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark bg-dark">
<span style="color: #FFF">AGBlogs.in</span>          </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


<style>


</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<center><div style="width: 70%">
    <h3 style="color: rgb(94, 94, 233)"><marquee>Latest Blogs by our users</marquee></h3>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                {{-- <th>Category</th> --}}
                <th>Image</th>
                <th>Description</th>
    
                <th>Posted Date</th>
              
            </tr>
        </thead>
        <tbody>
            {{-- //@if(count($posts) > 0) --}}
            {{-- @if(count(array($posts)) > 0); --}}
           {{-- // count((is_countable($posts)?$posts:[])) --}}
    
            @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                {{-- <td>{{$post->category->name}}</td> --}}
    
                <td width="30%"><img src="{{asset('uploads/'.$post->featured_image)}}" class="img-fluid" alt="img" style="max-width: 30%;"/></td>
                <td>{{$post->body}}</td>
                <td>{{formatDate($post->created_at)}}</td>
    
            </tr>
            @endforeach
            {{-- @else
            Post is not available   
        @endif    --}}
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                {{-- <th>Category</th> --}}
                <th>Image</th>
                <th>Description</th>
    
                <th>Posted Date</th>
            </tr>
        </tfoot>
    </table>

</div>

</center>
<div style = "position:relative;margin-left:205px"> <a href="http://127.0.0.1:8000/register">Sign Up</a>
    <p><a href="http://127.0.0.1:8000/login">Already Registered User ? Login</a></p>
    </div>

<script type="text/javascript">
$(document).ready(function () {
    $('#example').dataTable({
       "bInfo" : false,
       "info": false,
       "lengthChange": false

   });
});
</script>

<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>


<footer class="bg-white">
    <div class="container text-center py-3">&copy; All rights reserved to AGBlogs.in</div>
</footer>
