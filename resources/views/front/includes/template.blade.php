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
            sessionStorage: 'session-client-shop',
            cartTokenStorage: 'tokenCart',
            max_size_img: 10
        };

        const generateRandomString = (length) => {
            let result = '';
            const characters =
                'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
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
    {{-- <script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/i18n/es.js"></script>
    <script src="{{ asset('scripts/libraries/jquery.blockUI.min.js')}}"></script>
    
    {{-- <script src="{{ asset('scripts/frontend.js')}}"></script> --}}
    @yield('scripts_body_after')
    <script>
        /**
         * Check if a node is blocked for processing.
         *
         * @param {JQuery Object} $node
         * @return {bool} True if the DOM Element is UI Blocked, false if not.
         */
        var is_blocked = function( $node ) {
            return $node.is( '.processing' ) || $node.parents( '.processing' ).length;
        };

        /**
         * Block a node visually for processing.
         *
         * @param {JQuery Object} $node
         */
        var block = function( $node ) {
            if ( ! is_blocked( $node ) ) {
                $node.addClass( 'processing' ).block( {
                    message: null,
                    overlayCSS: {
                        background: '#fff',
                        opacity: 0.6
                    }
                } );
            }
        };

        /**
         * Unblock a node after processing is complete.
         *
         * @param {JQuery Object} $node
         */
        var unblock = function( $node ) {
            $node.removeClass( 'processing' ).unblock();
        };
    </script>
    <script>
        function openLoginForm() {
            $('#modalpanel-login').toggleClass('active');
        }
        function notifyErrorGlobal(params) {
            if (params.status == 500) {
                $.notify(
                    "Error interno", 
                    { position:"bottom right" }
                );
            }else{
                if(params.responseJSON.errors){
                    var errorsKey = Object.keys(params.responseJSON.errors);
                    for (const keyItem of errorsKey) {
                        var errorsMessages = params.responseJSON.errors[keyItem];
                        if(errorsMessages && Array.isArray(errorsMessages)){
                            for (const errorMessage of errorsMessages) {
                                $.notify(
                                    errorMessage, 
                                    { position:"bottom right",className:"warn" }
                                );
                            }
                        }
                    }
                }else{
                    $.notify(
                        params.responseJSON.message, 
                        { position:"bottom right",className:"warn" }
                    );
                }
            }
        }
    </script>

    <script>
        if (document.querySelector('.cart-contents-icon') != null) {
            
            function loadCartFloat() {
                $.easyAjax({
                    url: '{{ route('front.cart.get-items') }}',
                    type: "GET",
                    data: {
                        _token: '{{ csrf_token() }}',
                        tokenCart: localStorage.getItem(enviropments.cartTokenStorage)
                    },
                    success: function(response) {
                        $('.float-count-cart').html(response.count);
                        $('.float-total-cart').html(response.total_format);
                        // Each elements
                        var elListHTML= '';
                        for (const item of response.products) {
                            elListHTML += templateItemCart(item)
                        }
                        $('#product_list_widget_icart').html(elListHTML);
                        var route = '{{ route('front.cart.checkout', ':token')}}';
                        route = route.replace(':token', localStorage.getItem(enviropments.cartTokenStorage));
                        $('.checkout-button-route').attr('href', route);
                    },
                    error: function(error) {},
                });
            }
            function templateItemCart(item) {
                return `
                <li class="woocommerce-mini-cart-item mini_cart_item">
                    <a href="#"
                        onclick="removeItemShopInternal(${item.id})"
                        class="remove remove_from_cart_button" aria-label="Remove this item"
                        data-product_id="${item.id}"
                        data-cart_item_key="d6baf65e0b240ce177cf70da146c8dc8"
                        data-product_sku="${item.name}-61767652">x</a> <a
                        
                        href="${item.route}">
                        <img width="450" height="420"
                            src="${item.url_image}"
                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                            alt="" decoding="async">${item.name} </a>
                    <span class="quantity">${item.count} x <span
                            class="woocommerce-Price-amount amount"><bdi><span
                                    class="woocommerce-Price-currencySymbol">$</span>${item.total_format}</bdi></span></span>
                </li>
                `
                
            }

            /**
             * Remove a item 
             */
            function removeItemShopInternal(productCartId) {
                block($('#float-panel-cart-items'))
                $.easyAjax({
                    url: '{{ route('front.cart.remote-item') }}',
                    container: '#formUpdateItems',
                    type: "DELETE",
                    redirect: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        tokenCart: localStorage.getItem(enviropments.cartTokenStorage),
                        product_id: productCartId
                    },
                    success: function(response) {
                        if (response.message) {
                            $.notify(
                                response.message, 
                                { position:"bottom right",className:"success" }
                            );
                        }
                        loadCartFloat();
                        $('#price-total-element').html(response.total_format);
                        $('#body-items-products').html(response.html_items);
                        unblock($('#float-panel-cart-items'));
                    },
                    error: function(error) {
                        unblock($('#float-panel-cart-items'));
                        notifyErrorGlobal(error);
                    },
                });
                
            }
            loadCartFloat();
        }
    </script>
    @yield('scripts_body_last')

    <script>
        !function(a) {
            function resetRouteCheckout() {
                var route = '{{ route('front.cart.checkout', ':token')}}';
                route = route.replace(':token', localStorage.getItem(enviropments.cartTokenStorage));
                $('.checkout-button-route').attr('href', route);
            }
            resetRouteCheckout();
        }(jQuery);
        
    </script>
    @if(session('remove_token') && session('remove_token') == 'yes')
    <script>
        localStorage.removeItem(enviropments.cartTokenStorage);
    </script>
    {{ session()->forget('remove_token') }}
    @endif
</body>

</html>
