<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ config('app_project.title') }}</title>
    <meta name="description" content="{{ config('app_project.description') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/images/me/gafas.jpg') }}">
    <style>
        :root{
            --color-template-primary: #3A3C41;
        }
    </style>
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{ asset('styles/platform.client.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('styles/trunk.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('styles/trunk-480.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('styles/trunk-768.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('styles/trunk-1024.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('styles/trunk-1024.min.css') }}" type="text/css" media="all">
    @yield('links')
    @yield('scripts_head')
     <!-- Google tag (gtag.js) -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=G-SQMRZBXPBF"></script>
     <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());
 
     gtag('config', 'G-SQMRZBXPBF');
     </script> --}}
     @include('front.includes.head')
</head>

<body class="main">

    {{-- <!-- Preloader -->
    <div id="preloader">
        <div class="outer">
            <!-- Google Chrome -->
            <div class="infinityChrome">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <!-- Safari and others -->
            <div class="infinity">
                <div>
                    <span></span>
                </div>
                <div>
                    <span></span>
                </div>
                <div>
                    <span></span>
                </div>
            </div>
            <!-- Stuff -->
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="goo-outer">
                <defs>
                    <filter id="goo">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
                        <feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                        <feBlend in="SourceGraphic" in2="goo" />
                    </filter>
                </defs>
            </svg>
        </div>
    </div> --}}

    <!-- mobile header -->
    {{-- @include('front.components.sidebar') --}}

    @yield('main-content')


    @yield('scripts_body_before')


    @yield('scripts_body_after')

</body>

</html>
