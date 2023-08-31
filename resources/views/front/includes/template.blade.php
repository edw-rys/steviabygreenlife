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
    

    @if (currentRouteName() != 'front.index')
        <div class="freshio-overlay"></div>
        @include('front.includes.mobile-nav')
    @endif
    


    <script src="{{ asset('scripts/jquery.min.js') }}"></script>
    <script>
        $ = jQuery;
        const enviropments = {
            sessionStorage: 'session-client-shop'
        };
    </script>
    <script src="{{ asset('scripts/libraries/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('scripts/libraries/photoswipe/photoswipe.min.js') }}"></script>
    <script src="{{ asset('scripts/libraries/photoswipe/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('scripts/nav-mobile.js') }}"></script>
    {{-- <script src="{{ asset('scripts/libraries/frontend-modules.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('scripts/libraries/frontend.min.js')}}"></script> --}}
    <script type="text/javascript" id="wc-single-product-js-extra">
        /* <![CDATA[ */
        var wc_single_product_params = {
            "i18n_required_rating_text": "Please select a rating",
            "review_rating_required": "yes",
            "flexslider": {
                "rtl": false,
                "animation": "slide",
                "smoothHeight": true,
                "directionNav": false,
                "controlNav": "thumbnails",
                "slideshow": false,
                "animationSpeed": 500,
                "animationLoop": false,
                "allowOneSlide": false
            },
            "zoom_enabled": "1",
            "zoom_options": [],
            "photoswipe_enabled": "1",
            "photoswipe_options": {
                "shareEl": false,
                "closeOnScroll": false,
                "history": false,
                "hideAnimationDuration": 0,
                "showAnimationDuration": 0
            },
            "flexslider_enabled": "1"
        };
        /* ]]> */
    </script>
    <script src="{{ asset('scripts/libraries/single-product.js') }}"></script>
    <script src="{{ asset('scripts/app.js') }}"></script>
    <script src="{{ asset('scripts/libraries/select2.min.js')}}"></script>
    <script src="{{ asset('scripts/libraries/bootstrap-notify.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/i18n/es.js"></script>
    {{-- <script src="{{ asset('scripts/frontend.js')}}"></script> --}}
    @yield('scripts_body_after')
    <script>
        function openLoginForm() {
            $('#modalpanel-login').toggleClass('active');
        }
        function notifyErrorGlobal(params) {
            if (params.status == 500) {
                $.notify({
                    icon: 'flaticon-hands-1',
                    title: 'Error interno',
                    message: '',
                }, {
                    type: 'info',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                });
            }
            $.notify({
                icon: 'flaticon-hands-1',
                title: params.responseJSON.message,
                message: '',
            }, {
                type: 'warning',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                time: 1000,
            });
        }
    </script>
</body>

</html>
