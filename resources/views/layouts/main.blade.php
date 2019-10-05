<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lentrix - Judging System</title>
    <link rel="stylesheet" href="{{asset('font-awesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
    <script src="{{asset('js/jquery.js')}}"></script>
</head>
<body>

    @include('layouts.nav')

    <div class="container">
        @yield('content')
    </div>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    @yield('scripts')
</body>
</html>
