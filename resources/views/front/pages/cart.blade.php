@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
    page-template-default page page-id-75 wp-embed-responsive theme-freshio woocommerce-cart woocommerce-page woocommerce-js
    woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default
    freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2
    single-product-1 freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome
    e--ua-webkit
@endsection
{{-- End class rename --}}

@section('head-content')
    @include('front.includes.head-shop')
@endsection

{{-- Scripts --}}
@section('scripts_body_last')
    <script>
        @if($cart != null)
        localStorage.setItem(enviropments.cartTokenStorage, '{{ $cart->uuid}}');
        @endif

        function activeButtonRestartCart() {
            $('#update_cart').removeAttr('disabled')
        }
        function changeItemsCount(evt){
            evt.preventDefault();
            block($('#post-show-items-cart'))
            $('#tokenCartVal').val(localStorage.getItem(enviropments.cartTokenStorage));
            $.easyAjax({
                url: '{{ route('front.cart.change-items-count') }}',
                container: '#formUpdateItems',
                type: "POST",
                redirect: false,
                data: $('#formUpdateItems').serialize(),
                success: function(response) {
                    if (response.message) {
                        $.notify(
                            response.message, 
                            { position:"bottom right",className:"success" }
                        );
                    }
                    $('#price-discount-element').html( '-'+response.discount_format);
                    if(!(+response.discount_format)){
                        $('#discount-foot-el').addClass('hidden')
                    }else{
                        $('#discount-foot-el').removeClass('hidden')
                    }
                    $('#price-total-element').html(response.total_format);
                    $('#body-items-products').html(response.html_items);
                    unblock($('#post-show-items-cart'));
                },
                error: function(error) {
                    unblock($('#post-show-items-cart'));
                    notifyErrorGlobal(error);
                },
            });
        }

        function reloadItems() {
            block($('#post-show-items-cart'))
            $.easyAjax({
                url: '{{ route('front.cart.reload-items') }}',
                container: '#formUpdateItems',
                type: "GET",
                redirect: false,
                data: {tokenCart: localStorage.getItem(enviropments.cartTokenStorage)},
                success: function(response) {
                    $('#price-total-element').html(response.total_format);
                    $('#price-discount-element').html( '-'+response.discount_format);
                    if(!(+response.discount_format)){
                        $('#discount-foot-el').addClass('hidden')
                    }else{
                        $('#discount-foot-el').removeClass('hidden')
                    }
                    
                    $('#body-items-products').html(response.html_items);
                    unblock($('#post-show-items-cart'));
                    $('.cart-collaterals').removeClass('hidden');
                },
                error: function(error) {
                    unblock($('#post-show-items-cart'));
                    notifyErrorGlobal(error);
                },
            });
        }

        /**
         * Remove a item 
         */
        function removeItemShop(productCartId) {
            block($('#post-show-items-cart'))
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
                    $('#price-discount-element').html( '-'+response.discount_format);
                    if(!(+response.discount_format)){
                        $('#discount-foot-el').addClass('hidden')
                    }else{
                        $('#discount-foot-el').removeClass('hidden')
                    }
                    $('#price-total-element').html(response.total_format);
                    $('#body-items-products').html(response.html_items);
                    unblock($('#post-show-items-cart'));
                },
                error: function(error) {
                    unblock($('#post-show-items-cart'));
                    notifyErrorGlobal(error);
                },
            });
        }

        /**
         * Remove a item 
         */
         function applyDiscount() {
            block($('#post-show-items-cart'))
            $.easyAjax({
                url: '{{ route('front.cart.apply-discount') }}',
                container: '#formUpdateItems',
                type: "POST",
                redirect: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    tokenCart: localStorage.getItem(enviropments.cartTokenStorage),
                    code: $('#coupon_code').val()
                },
                success: function(response) {
                    if (response.message) {
                        $.notify(
                            response.message, 
                            { position:"bottom right",className:"success" }
                        );
                    }
                    $('#price-discount-element').html( '-'+response.discount_format);
                    if(!(+response.discount_format)){
                        $('#discount-foot-el').addClass('hidden')
                    }else{
                        $('#discount-foot-el').removeClass('hidden')
                    }
                    $('#price-total-element').html(response.total_format);
                    $('#body-items-products').html(response.html_items);
                    unblock($('#post-show-items-cart'));
                },
                error: function(error) {
                    unblock($('#post-show-items-cart'));
                    notifyErrorGlobal(error);
                },
            });
        }

        reloadItems();
    </script>
@endsection

@section('main-content')
    @include('front.pages.shop.header')
    <div class="freshio-breadcrumb">
        <div class="col-full">
            <h1 class="breadcrumb-heading color-white">Compras</h1>

            <nav class="woocommerce-breadcrumb color-white"><a class="color-white"
                    href="{{ route('front.shop') }}">Inicio</a><span class="breadcrumb-separator color-white"> /
                </span>Compras</nav>
        </div>
    </div>


    {{-- Cart --}}
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">

            <div class="woocommerce"></div>
            <div id="primary">
                <main id="main" class="site-main" role="main">

                    <article id="post-show-items-cart" class="post-75 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper"></div>
                                <form class="woocommerce-cart-form" id="formUpdateItems" action="{{route('front.cart.change-items-count')}}" onsubmit="changeItemsCount(event)"
                                    method="post">
                                    <input type="hidden" name="tokenCart" id="tokenCartVal" value="">
                                    @csrf
                                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="screen-reader-text">Quitar</span></th>
                                                <th class="product-thumbnail"><span class="screen-reader-text">Imagen</span></th>
                                                <th class="product-name">Producto</th>
                                                <th class="product-price">Precio</th>
                                                <th class="product-quantity">Cantidad</th>
                                                <th class="product-subtotal">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-items-products">
                                            @include('front.pages.cart.body-table')
                                        </tbody>
                                    </table>
                                </form>

                                

                                <div class="cart-collaterals @if ($cart == null) hidden @endif">
                                    <div class="cart_totals ">


                                        <h2>Valor a pagar</h2>

                                        <table cellspacing="0" class="shop_table shop_table_responsive">

                                            <tbody>
                                                <tr class="order-discount" id="discount-foot-el">
                                                    <th>Descuento</th>
                                                    <td data-title="Total">
                                                        <strong>
                                                            <span class="woocommerce-Price-amount" style="font-size: 24px">
                                                                <bdi>
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                                                    <span id="price-discount-element">- {{ $cart != null ? $cart->discount_code_format : '0.00'}}</span>
                                                                </bdi>
                                                            </span>
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td data-title="Total">
                                                        <strong>
                                                            <span class="woocommerce-Price-amount amount">
                                                                <bdi>
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                                                    <span id="price-total-element">{{ $cart != null ? $cart->total_format : '0.00'}}</span>
                                                                </bdi>
                                                            </span>
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="wc-proceed-to-checkout">

                                            <a href=""
                                                class="checkout-button-route checkout-button button alt wc-forward wp-element-button">
                                                Proceder a pagar</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div><!-- .entry-content -->
                    </article><!-- #post-## -->
                </main><!-- #main -->
            </div><!-- #primary -->


        </div><!-- .col-full -->
    </div>
@endsection
