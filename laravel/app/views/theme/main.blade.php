<!doctype html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title')</title>

    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="{{ asset('/packages/amazeui/dist/css/amazeui.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <script type="text/javascript"
      src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
</head>

<body>
    <header class="am-topbar am-topbar-inverse">
        <h1 class="am-topbar-brand">
            <a class="navbar-brand" href="{{ url('/') }}">Researchew</a>
        </h1>
        <div class="am-topbar-right">
            @if(!Auth::check())
            <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm" href="/user/login">Login</a>
            <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm" href="/user/reg">Register</a>
            @else
            <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm" href="/user/logout">Logout</a>
            @endif
        </div>
    </header>

    @yield('content')

    <footer class="am-link-muted am-text-center am-text-xs">
        CS411 @ University of Illinois at Urbana-Champaign
    </footer>

    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="{{ asset('/packages/jquery/dist/jquery.min.js') }}"></script>
    <!--<![endif]-->
    <!--[if lte IE 8 ]>
    <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
    <![endif]-->
    <script src="{{ asset('/packages/amazeui/dist/js/amazeui.min.js ') }}"></script>
    <script type="text/x-mathjax-config">
      MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}, });
    </script>
    @yield('script')
</body>

</html>
