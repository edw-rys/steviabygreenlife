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
@section('scripts_body_after')
    <script>
        function loadCart(params) {

            $.easyAjax({
                url: '{{ route('front.cart.get-items') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    session: localStorage.getItem(enviropments.sessionStorage)
                },
                success: function(response) {
                    if (response.status == 'uploaded_pages') {
                        $(element).html(response.html)
                        $(element).removeClass('reload-noupload');
                    }
                },
                error: function(error) {},
            });
            
        }
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

                    <article id="post-75" class="post-75 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper"></div>
                                <form class="woocommerce-cart-form" action="https://demo2.pavothemes.com/freshio/cart/"
                                    method="post">

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
                                        <tbody>
                                            <tr class="woocommerce-cart-form__cart-item cart_item">

                                                <td class="product-remove">
                                                    <a href="https://demo2.pavothemes.com/freshio/cart/?remove_item=f7664060cc52bc6f3d620bcedc94a4b6&amp;_wpnonce=306f616ba0"
                                                        class="remove" aria-label="Remove this item" data-product_id="266"
                                                        data-product_sku="durable-aluminum-shoes-62990271">×</a>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a
                                                        href="https://demo2.pavothemes.com/freshio/product/durable-aluminum-shoes/"><img
                                                            width="450" height="420"
                                                            src="https://demo2.pavothemes.com/freshio/wp-content/uploads/2020/08/27-450x420.jpg"
                                                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                            alt="" decoding="async"></a>
                                                </td>

                                                <td class="product-name" data-title="Product">
                                                    <a
                                                        href="https://demo2.pavothemes.com/freshio/product/durable-aluminum-shoes/">Durable
                                                        Aluminum Shoes</a>
                                                </td>

                                                <td class="product-price" data-title="Price">
                                                    <span class="woocommerce-Price-amount amount"><bdi><span
                                                                class="woocommerce-Price-currencySymbol">£</span>366.90</bdi></span>
                                                </td>

                                                <td class="product-quantity" data-title="Quantity">
                                                    <div class="quantity">
                                                        <label class="screen-reader-text"
                                                            for="quantity_64ed187aef1a4">Durable Aluminum Shoes
                                                            quantity</label>
                                                        <input type="number" id="quantity_64ed187aef1a4"
                                                            class="input-text qty text" step="1" min="0"
                                                            max="97"
                                                            name="cart[f7664060cc52bc6f3d620bcedc94a4b6][qty]"
                                                            value="2" title="Qty" size="4" placeholder=""
                                                            inputmode="numeric" autocomplete="off">
                                                    </div>
                                                </td>

                                                <td class="product-subtotal" data-title="Subtotal">
                                                    <span class="woocommerce-Price-amount amount"><bdi><span
                                                                class="woocommerce-Price-currencySymbol">£</span>733.80</bdi></span>
                                                </td>
                                            </tr>
                                            <tr class="woocommerce-cart-form__cart-item cart_item">

                                                <td class="product-remove">
                                                    <a href="https://demo2.pavothemes.com/freshio/cart/?remove_item=4ff6731e7d7a3f65920d41c42cb864fb&amp;_wpnonce=306f616ba0"
                                                        class="remove" aria-label="Remove this item" data-product_id="285"
                                                        data-product_sku="">×</a>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a
                                                        href="https://demo2.pavothemes.com/freshio/product/ergonomic-iron-clock/?attribute_pa_numeric-size=16"><img
                                                            width="450" height="420"
                                                            src="https://demo2.pavothemes.com/freshio/wp-content/uploads/2020/08/image-43-copyright-min-450x420.jpg"
                                                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                            alt="" decoding="async"></a>
                                                </td>

                                                <td class="product-name" data-title="Product">
                                                    <a
                                                        href="https://demo2.pavothemes.com/freshio/product/ergonomic-iron-clock/?attribute_pa_numeric-size=16">Ergonomic
                                                        Iron Clock - 16</a>
                                                </td>

                                                <td class="product-price" data-title="Price">
                                                    <span class="woocommerce-Price-amount amount"><bdi><span
                                                                class="woocommerce-Price-currencySymbol">£</span>930.97</bdi></span>
                                                </td>

                                                <td class="product-quantity" data-title="Quantity">
                                                    1 <input type="hidden"
                                                        name="cart[4ff6731e7d7a3f65920d41c42cb864fb][qty]" value="1">
                                                </td>

                                                <td class="product-subtotal" data-title="Subtotal">
                                                    <span class="woocommerce-Price-amount amount"><bdi><span
                                                                class="woocommerce-Price-currencySymbol">£</span>930.97</bdi></span>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td colspan="6" class="actions">

                                                    <div class="coupon">
                                                        <label for="coupon_code">Coupon:</label> <input type="text"
                                                            name="coupon_code" class="input-text" id="coupon_code"
                                                            value="" placeholder="Coupon code"> <button
                                                            type="submit" class="button wp-element-button"
                                                            name="apply_coupon" value="Apply coupon">Apply coupon</button>
                                                    </div>

                                                    <button type="submit" class="button wp-element-button"
                                                        name="update_cart" value="Update cart" disabled=""
                                                        aria-disabled="true">Update cart</button>


                                                    <input type="hidden" id="woocommerce-cart-nonce"
                                                        name="woocommerce-cart-nonce" value="306f616ba0"><input
                                                        type="hidden" name="_wp_http_referer" value="/freshio/cart/">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </form>


                                <div class="cart-collaterals">
                                    <div class="cart_totals ">


                                        <h2>Cart totals</h2>

                                        <table cellspacing="0" class="shop_table shop_table_responsive">

                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td data-title="Subtotal"><span
                                                            class="woocommerce-Price-amount amount"><bdi><span
                                                                    class="woocommerce-Price-currencySymbol">£</span>1,664.77</bdi></span>
                                                    </td>
                                                </tr>






                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td data-title="Total"><strong><span
                                                                class="woocommerce-Price-amount amount"><bdi><span
                                                                        class="woocommerce-Price-currencySymbol">£</span>1,664.77</bdi></span></strong>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>

                                        <div class="wc-proceed-to-checkout">

                                            <a href="{{ route('front.cart.checkout')}}"
                                                class="checkout-button button alt wc-forward wp-element-button">
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
