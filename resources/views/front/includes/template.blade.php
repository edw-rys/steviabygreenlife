<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
  
    @yield('head-content')
</head>
<body class="@yield('class-body-template')">
{{-- <body class="theme archive post-type-archive post-type-archive-product wp-embed-responsive theme-freshio woocommerce-shop woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-archive-product freshio-sidebar-left freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit"> --}}
{{-- <body class="class-body-templateproduct-template-default single single-product postid-285 wp-embed-responsive theme-freshio woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-full-width-content freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit"> --}}

    
    @yield('main-content')


    @yield('scripts_body_before')


    <script src="{{ asset('scripts/jquery.min.js')}}"></script>
    <script>
        $=jQuery;
        const enviropments = {
            sessionStorage:'session-client-shop'
        };    
    </script>
    <script src="{{ asset('scripts/app.js')}}"></script>
    {{-- <script src="{{ asset('scripts/frontend.js')}}"></script> --}}
    @yield('scripts_body_after')
    <script>
        function openLoginForm() {
            $('#modalpanel-login').toggleClass('active');
        }
    </script>
</body>

</html>
