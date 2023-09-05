<header id="masthead" class="site-header header-2" role="banner" style="">
    <div class="header-main">
        <div class="inner">
            <div class="left">
                <div class="site-branding">
                    <a href="{{ route('front.shop') }}" class="custom-logo-link" rel="home"><img
                            src="{{ asset('images/shop/logo.png') }}" class="logo-light lazyloaded" alt="Logo"
                            data-ll-status="loaded"><noscript><img src="{{ asset('images/shop/logo.png') }}"
                                class="logo-light" alt="Logo" /></noscript></a>
                </div>

                <div class="site-header-cart header-cart-mobile" >
                    <div style="display: grid;grid-template-columns: 1fr 1fr;">
                        <div class="site-header-account-mobile">
                            <a href="#!" class="menu-mobile-nav-button"><i class="freshio-icon-user"></i></a>
                        </div>
                        <a class="cart-contents" href="{{ route('front.cart.show') }}"
                            title="Ver su carrito de compras">
                            <span class="count float-count-cart">0</span>
                            <span class="woocommerce-Price-amount amount"><span
                                    class="woocommerce-Price-currencySymbol">$</span class="float-total-cart">0.00</span> </a>
                    </div>

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
                        @if (auth()->check())
                            <a onclick="openLoginForm()"><i class="freshio-icon-user"></i></a>
                            <div class="account-dropdown c-pointer" id="modalpanel-login">
        
                                <div class="account-wrap" style="display: none;">
                                    <div class="account-inner ">
                                        @if (auth()->check())
                                            <p>
                                                <a class="" href="#!">
                                                    <span class="menu-title">{{ auth()->user()->full_name }} </span>
                                                </a>
                                            </p>
                                            <p>
                                                <a class="ref-link-style" href="{{ route('user.profile')}}">
                                                    <span class="menu-title"> > Mi perfil</span>
                                                </a>
                                            </p>
                                            <p>
                                                <a class="ref-link-style" href="{{ route('user.favorites')}}">
                                                    <span class="menu-title"> > Mis favoritos</span>
                                                </a>
                                            </p>
                                                <a class="ref-link-style" href="{{ route('user.shopping')}}">
                                                    <span class="menu-title"> > Mis compras</span>
                                                </a>
                                            </p>
                                            </p>
                                                <a class="ref-link-style" href="{{ route('user.logout')}}">
                                                    <span class="menu-title"> > Cerrar sesión</span>
                                                </a>
                                            </p>
                                        @else
                                            <p>
                                                <a class="ref-link-style" href="{{ route('auth.login')}}">
                                                    <span class="menu-title">Iniciar sesión</span>
                                                </a>
                                            </p>
                                            <p>
                                                <a class="ref-link-style" href="{{ route('auth.register')}}">
                                                    <span class="menu-title">Crar usuario</span>
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('auth.login')}}"><i class="freshio-icon-user"></i></a>
                            
                        @endif
                    </div>
                    <div class="site-header-cart menu">
                        <a class="cart-contents cart-contents-icon" href="{{ route('front.cart.show')}}"
                            title="Ver su carrito de compras">
                            <span class="count float-count-cart">0</span>
                            <span class="woocommerce-Price-amount amount"><span
                                    class="woocommerce-Price-currencySymbol">$</span><span class="float-total-cart">0.00</span></span> </a>

                        {{-- <div class="widget woocommerce widget_shopping_cart">
                            <div class="widget_shopping_cart_content">

                                <p class="woocommerce-mini-cart__empty-message">No products in the cart.</p>


                            </div>
                        </div> --}}
                        <div class="widget woocommerce widget_shopping_cart" id="float-panel-cart-items">
                            <div class="widget_shopping_cart_content">
                                <div class="woocommerce-mini-cart-scroll">
                                    <ul class="woocommerce-mini-cart cart_list product_list_widget" id="product_list_widget_icart">
                                    </ul>
                                </div>

                                <p class="woocommerce-mini-cart__total total">
                                    <strong>Subtotal:</strong> <span class="woocommerce-Price-amount amount"><bdi><span
                                                class="woocommerce-Price-currencySymbol">$</span><span class="float-total-cart">0.00</span></bdi></span>
                                </p>


                                <p class="woocommerce-mini-cart__buttons buttons">
                                    <a
                                        href="{{ route('front.cart.show') }}"
                                        class="button wc-forward wp-element-button">Ir al carrito</a>
                                    <a
                                        href=""
                                        class="checkout-button-route button checkout wc-forward wp-element-button">Pagar</a></p>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
