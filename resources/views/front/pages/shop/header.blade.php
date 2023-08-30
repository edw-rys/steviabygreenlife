<header id="masthead" class="site-header header-2" role="banner" style="">
    <div class="header-main">
        <div class="inner">
            <div class="left">
                <div class="site-branding">
                    <a href="{{ route('front.index') }}" class="custom-logo-link" rel="home"><img
                            src="{{ asset('images/shop/logo.png') }}" class="logo-light lazyloaded" alt="Logo"
                            data-ll-status="loaded"><noscript><img src="{{ asset('images/shop/logo.png') }}"
                                class="logo-light" alt="Logo" /></noscript><img
                            src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E"
                            class="logo-dark" alt="Logo"
                            data-lazy-src="https://demo2wpopal.b-cdn.net/freshio/wp-content/uploads/2020/08/logo-light.svg"><noscript><img
                                src="https://demo2wpopal.b-cdn.net/freshio/wp-content/uploads/2020/08/logo-light.svg"
                                class="logo-dark" alt="Logo" /></noscript></a>
                </div>
                <div class="site-header-cart header-cart-mobile">
                    <a class="cart-contents" href="https://demo2.pavothemes.com/freshio/cart/"
                        title="View your shopping cart">
                        <span class="count">0</span>
                        <span class="woocommerce-Price-amount amount"><span
                                class="woocommerce-Price-currencySymbol">£</span>0.00</span> </a>

                </div>
            </div>
            <div class="center desktop-hide-down">
                <div class="site-search">
                    <div class="widget woocommerce widget_product_search">
                        <div class="ajax-search-result" style="display:none;">
                        </div>
                        <form role="search" method="get" class="woocommerce-product-search"
                            action="{{ route('front.shop') }}">
                            <label class="screen-reader-text" for="woocommerce-product-search-field-0">Search
                                for:</label>
                            <input type="search" id="woocommerce-product-search-field-0" class="search-field"
                                placeholder="Buscar producto…" autocomplete="off" value="" name="s">
                            <button type="submit" value="Search">Buscar</button>
                            <input type="hidden" name="post_type" value="product">
                        </form>
                    </div>
                </div>
            </div>
            <div class="right desktop-hide-down">
                <div class="header-group-action">
                    <div class="freshio-contact">
                        <div class="contact_inner">
                            <div class="contact_icon">
                                <i class="freshio-icon-headphones-alt" aria-hidden="true"></i>
                            </div>
                            <div class="contact_content">
                                <span class="sub-title">Llámanos:</span>
                                <span class="title">042739211 - 042739400</span>

                            </div>
                        </div>
                    </div>
                    <div class="site-header-account">
                        <a onclick="openLoginForm()"><i class="freshio-icon-user"></i></a>
                        <div class="account-dropdown c-pointer" id="modalpanel-login">
    
                            <div class="account-wrap" style="display: none;">
                                <div class="account-inner ">
    
                                    <div class="login-form-head">
                                        <span class="login-form-title">Iniciar sesión</span>
                                        <span class="pull-right">
                                            <a class="register-link" href="{{ route('auth.register')}}"
                                                title="Register">Crear cuenta</a>
                                        </span>
                                    </div>
                                    <form class="freshio-login-form-ajax" data-toggle="validator" method="POST" action="{{ route('auth.login.post')}}">
                                        @csrf
                                        <p>
                                            <label>Email <span class="required">*</span></label>
                                            <input name="username" type="text" required="" placeholder="Correo electrónico">
                                        </p>
                                        <p>
                                            <label>Contraseña <span class="required">*</span></label>
                                            <input name="password" type="password" required="" placeholder="Contraseña">
                                        </p>
                                        <button type="submit" data-button-action=""
                                            class="btn btn-primary btn-block w-100 mt-1">Login</button>
                                        <input type="hidden" name="action" value="freshio_login">
                                        <input type="hidden" id="security-login" name="security-login"
                                            value="294708f767"><input type="hidden" name="_wp_http_referer"
                                            value="/freshio/cart/">
                                    </form>
                                    <div class="login-form-bottom">
                                        <a href="{{ route('front.forgotyourpassword') }}"
                                            class="lostpass-link" title="Lost your password?">Olvidé mi contraseña</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="site-header-cart menu">
                        <a class="cart-contents" href="{{ route('front.cart.show')}}"
                            title="View your shopping cart">
                            <span class="count">0</span>
                            <span class="woocommerce-Price-amount amount"><span
                                    class="woocommerce-Price-currencySymbol">$</span>0.00</span> </a>

                        {{-- <div class="widget woocommerce widget_shopping_cart">
                            <div class="widget_shopping_cart_content">

                                <p class="woocommerce-mini-cart__empty-message">No products in the cart.</p>


                            </div>
                        </div> --}}
                        <div class="widget woocommerce widget_shopping_cart">
                            <div class="widget_shopping_cart_content">
                                <div class="woocommerce-mini-cart-scroll">
                                    <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                                        <li class="woocommerce-mini-cart-item mini_cart_item">
                                            <a href="https://demo2.pavothemes.com/freshio/cart/?remove_item=d6baf65e0b240ce177cf70da146c8dc8&amp;_wpnonce=306f616ba0"
                                                class="remove remove_from_cart_button" aria-label="Remove this item"
                                                data-product_id="264"
                                                data-cart_item_key="d6baf65e0b240ce177cf70da146c8dc8"
                                                data-product_sku="enormous-silk-computer-61767652">×</a> <a
                                                href="https://demo2.pavothemes.com/freshio/product/enormous-silk-computer/">
                                                <img width="450" height="420"
                                                    src="https://demo2.pavothemes.com/freshio/wp-content/uploads/2020/08/25-450x420.jpg"
                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                    alt="" decoding="async">Enormous Silk Computer </a>
                                            <span class="quantity">1 × <span
                                                    class="woocommerce-Price-amount amount"><bdi><span
                                                            class="woocommerce-Price-currencySymbol">£</span>829.58</bdi></span></span>
                                        </li>
                                        <li class="woocommerce-mini-cart-item mini_cart_item">
                                            <a href="https://demo2.pavothemes.com/freshio/cart/?remove_item=f7664060cc52bc6f3d620bcedc94a4b6&amp;_wpnonce=306f616ba0"
                                                class="remove remove_from_cart_button" aria-label="Remove this item"
                                                data-product_id="266"
                                                data-cart_item_key="f7664060cc52bc6f3d620bcedc94a4b6"
                                                data-product_sku="durable-aluminum-shoes-62990271">×</a> <a
                                                href="https://demo2.pavothemes.com/freshio/product/durable-aluminum-shoes/">
                                                <img width="450" height="420"
                                                    src="https://demo2.pavothemes.com/freshio/wp-content/uploads/2020/08/27-450x420.jpg"
                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                    alt="" decoding="async">Durable Aluminum Shoes </a>
                                            <span class="quantity">2 × <span
                                                    class="woocommerce-Price-amount amount"><bdi><span
                                                            class="woocommerce-Price-currencySymbol">£</span>366.90</bdi></span></span>
                                        </li>
                                        <li class="woocommerce-mini-cart-item mini_cart_item">
                                            <a href="https://demo2.pavothemes.com/freshio/cart/?remove_item=4ff6731e7d7a3f65920d41c42cb864fb&amp;_wpnonce=306f616ba0"
                                                class="remove remove_from_cart_button" aria-label="Remove this item"
                                                data-product_id="285"
                                                data-cart_item_key="4ff6731e7d7a3f65920d41c42cb864fb"
                                                data-product_sku="">×</a> <a
                                                href="https://demo2.pavothemes.com/freshio/product/ergonomic-iron-clock/?attribute_pa_numeric-size=16">
                                                <img width="450" height="420"
                                                    src="https://demo2.pavothemes.com/freshio/wp-content/uploads/2020/08/image-43-copyright-min-450x420.jpg"
                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                    alt="" decoding="async">Ergonomic Iron Clock - 16 </a>
                                            <span class="quantity">1 × <span
                                                    class="woocommerce-Price-amount amount"><bdi><span
                                                            class="woocommerce-Price-currencySymbol">£</span>930.97</bdi></span></span>
                                        </li>
                                    </ul>
                                </div>

                                <p class="woocommerce-mini-cart__total total">
                                    <strong>Subtotal:</strong> <span class="woocommerce-Price-amount amount"><bdi><span
                                                class="woocommerce-Price-currencySymbol">$</span>2,494.35</bdi></span>
                                </p>


                                <p class="woocommerce-mini-cart__buttons buttons"><a
                                        href="{{ route('front.cart.show') }}"
                                        class="button wc-forward wp-element-button">Ir al carrito</a><a
                                        href="{{ route('front.cart.checkout') }}"
                                        class="button checkout wc-forward wp-element-button">Pagar</a></p>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
