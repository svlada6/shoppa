<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8" />
        <title>Green St. Coffee</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,400italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Cabin+Sketch:400,700' rel='stylesheet' type='text/css'>
        <script src="{{ asset('site_assets/js/jquery-2.2.1.min.js') }}"></script>
        <script src="{{ asset('site_assets/js/function.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('site_assets/css/reset.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('site_assets/css/coffee.css') }}" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.js"></script>
 
    </head>

    <body @yield('body_id')>        
        <!-- Header -->
        @include('site._includes.header')
        <!-- ./ header -->

        <!-- Main content -->
        @yield('content')
        <!-- /.Main content -->

        <!-- Footer -->
        @include('site._includes.footer')
        <!-- ./ footer -->

        @yield('scripts')       
    </body>
</html>