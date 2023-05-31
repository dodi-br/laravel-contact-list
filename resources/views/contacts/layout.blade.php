<!DOCTYPE html>
<html>
<head>
    <title>My Contact List</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>
<body>
  
<div class="container" style="margin-top: 15px;">
    <div class="row">
        @auth
            {{auth()->user()->name}}
            <div class="pull-right">
                <a href="{{ route('logout.do') }}" class="btn btn-outline-light me-2">Logout</a>
            </div>
        @endauth

        @guest
            <div class="pull-right">
                <a href="{{ route('login.do') }}" class="btn btn-outline-light me-2">Login</a>
            </div>
        @endguest
    </div>
    @yield('content')
</div>
   
</body>
</html>