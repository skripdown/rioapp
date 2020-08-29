<!doctype html>
<html lang="{{env('APP_LANG')}}" dir="{{env('APP_DIR')}}">
    <head>
        <meta charset="{{env('APP_CHARSET')}}">
        <meta name="viewport" content="{{env('APP_VIEWPORT')}}">
        <meta name="description" content="{{env('APP_DESCRIPTION')}}">
        <meta name="author" content="{{env('APP_AUTHOR')}}">
        <title>{{env('APP_NAME')}} | @yield('title')</title>
        <link rel="icon" type="image/png" sizes="{{env('ICON_SIZE')}}" href="{{asset(env('ICON_SOURCE'))}}">
        <link rel="stylesheet" href="{{asset('element/css/style.min.css')}}">
        @yield('style')
        <script src="{{asset('element/lib/extra/html5shiv/html5shiv.js')}}"></script>
        <script src="{{asset('element/lib/extra/respond/respond.js')}}"></script>
        @include('script.jquery')
        @yield('script-head')
    </head>
    <body>
        <div class="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
            @include('html.preloader')
            @yield('content')
        </div>
        <script src="{{asset('element/lib/core/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('element/lib/core/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        @yield('script-body')
        @include('script.preloader')
    </body>
</html>
