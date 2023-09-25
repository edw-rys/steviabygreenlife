<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<link rel="icon" href="{{ asset('images/logo/favicon-3224021.svg') }}">
<title>{{ config('app.name') }}</title>

@include('front.includes.metadata')
<link rel="stylesheet" href="{{ asset('styles/shop/font-awesome.css') }}?v={{ config('app.website_version')}}">
{{-- <link rel="stylesheet" href="{{ asset('styles/shop/shop.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('styles/shop/woocommerce.css') }}?v={{ config('app.website_version')}}">
<link rel="stylesheet" href="{{ asset('styles/shop/style.css') }}?v={{ config('app.website_version')}}">
<link rel="stylesheet" href="{{ asset('styles/shop/photoswipe/photoswipe.min.css')}}">
<link rel="stylesheet" href="{{ asset('styles/shop/photoswipe/default-skin/default-skin.min.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<style id="freshio_options-dynamic-css" title="dynamic-css" class="redux-options-output">
    body,
    button,
    input,
    textarea {
        font-display: swap;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    blockquote,
    .widget .widget-title {
        font-display: swap;
    }

    .mobile-navigation ul li a,
    .mobile-navigation .dropdown-toggle,
    body .freshio-mobile-nav .freshio-social ul li a:before,
    .mobile-nav-close {
        color: #ffffff;
    }

    .freshio-breadcrumb {
        background-position: center center;
        /* background-image: url('{{asset('images/shop/banner-mobile.png')}}'); */
    }

    
    /* body.woocommerce-page:not(.single-product) .freshio-breadcrumb {
            background-position: center center;
            background-image: url('{{asset('images/shop/banner-short-mobile.png')}}');
            background-size: 100%;
                background-repeat: no-repeat;
        } */
    /* @media (min-width: 450px) {
        body.woocommerce-page:not(.single-product) .freshio-breadcrumb {
            background-position: center center;
            background-image: url('{{asset('images/shop/banner-mobile.png')}}');
            background-size: 100%;
                background-repeat: no-repeat;
        }
    }
    @media (min-width: 650px) {
        body.woocommerce-page:not(.single-product) .freshio-breadcrumb {
            background-size: 100%;
            background-repeat: no-repeat;
            background-image: url('{{asset('images/shop/banner-renovado.png')}}');
        }
    } */
    .color-white{
        color: #ffffff !important;
    }
    .hidden{
        display: none !important;
    }
    .c-pointer{
        cursor: pointer;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('styles/select2.min.css')}}">

<noscript>
    <style id="rocket-lazyload-nojs-css">
        .rll-youtube-player,
        [data-lazy-src] {
            display: none !important;
        }
    </style>
</noscript>
