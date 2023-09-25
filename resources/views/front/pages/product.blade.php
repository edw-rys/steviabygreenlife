@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
class-body-templateproduct-template-default single single-product postid-285 wp-embed-responsive theme-freshio woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-full-width-content freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit @endsection
{{-- End class rename --}}

@section('head-content')
    @include('front.includes.head-shop')
    
@endsection
@section('main-content')
    @include('front.pages.shop.header')
    <div class="hoja-lateral-design" style="background: #fff;"></div>
    <div class="freshio-breadcrumb ">
        <div class="col-full ">
            <h1 class="breadcrumb-heading hidden">{{ $product->name }} </h1>
            <nav class="woocommerce-breadcrumb" style="font-size: 1.1em;">
                <a  href="{{ route('front.shop')}}">Inicio</a>
                @if ($product->category != null)
                    <span  class="breadcrumb-separator"> / </span><a href="{{ route('front.shop.category', $product->category->system_name)}}">{{ $product->category->name }}</a>
                @endif
                <span class="breadcrumb-separator"> / </span> <span class="text-blue-tono bold">{{ $product->name }}</span>
            </nav>
        </div>
    </div>



    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            @if (session('add_cart_success'))
                <div class="woocommerce">
                    <div class="woocommerce-message" role="alert">
                        <a href="{{ route('front.cart')}}" class="button wc-forward wp-element-button">Ver carrito</a> “{{ $product->name }}” Ha sido agregado a su carrito.
                    </div>
                </div>
                {{ session()->forget('add_cart_success') }}  
            @endif

            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div id="product-{{ $product->id }}"
                        class="product type-product post-{{ $product->id }} status-publish first instock product_cat-uncategorized product_cat-package-foods has-post-thumbnail shipping-taxable purchasable product-type-simple">
                        <div class="content-single-wrapper">
                            <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images woocommerce-product-gallery-horizontal"
                                data-columns="4" style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;"><a
                                    href="#" class="woocommerce-product-gallery__trigger"><img draggable="false"
                                        role="img" class="emoji" alt="🔍"
                                        src="{{ asset('images/shop/1f50d.svg')}}"></a>
                                <figure class="woocommerce-product-gallery__wrapper border-blue">
                                    <div data-thumb="{{ $product->url_image }}"
                                        data-thumb-alt="" class="woocommerce-product-gallery__image"
                                        style="position: relative; overflow: hidden;"><a
                                            href="{{ $product->url_image }}"
                                            data-elementor-open-lightbox="no"><img width="800" height="693"
                                                src="{{ $product->url_image }}"
                                                class="wp-post-image" alt="" decoding="async" title="25"
                                                data-caption=""
                                                data-src="{{ $product->url_image }}"
                                                data-large_image="{{ $product->url_image }}"
                                                data-large_image_width="900" data-large_image_height="780"
                                                srcset="{{ $product->url_image }} 800w, {{ $product->url_image }} 300w, {{ $product->url_image }} 768w, {{ $product->url_image }} 900w"
                                                sizes="(max-width: 800px) 100vw, 800px"></a><img role="presentation"
                                            alt=""
                                            src="{{ $product->url_image }}"
                                            class="zoomImg"
                                            style="position: absolute; top: -4.25283px; left: -343.286px; opacity: 0; width: 900px; height: 780px; border: none; max-width: none; max-height: none;">
                                    </div>
                                </figure>
                            </div>
                            <div class="summary entry-summary" id="product-cart-item-shop" style="margin-top: 50px">
                                <span class="inventory_status">En Stock</span>
                                <h2 class="product_title entry-title title-product-redisign"><span class="item-title-link">{{ $product->name }}</span></h2>


                                <p class="price">
                                    @if ($product->discount_percentage > 0)
                                        <del aria-hidden="true"><span class="woocommerce-Price-amount amount">
                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $product->original_price_format}}</bdi>
                                        </span></del> 
                                    @endif
                                    <ins><span class="woocommerce-Price-amount amount"><bdi class="style-total-redisign"><span class="woocommerce-Price-currencySymbol ">$</span>{{ $product->price_format }}</bdi></span></ins>
                                </p>

                                {{-- <p class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $product->price_format}}</bdi></span></p> --}}

                                <div class="woocommerce-product-details__short-description">
                                    {!! $product->description !!}
                                </div>
                                <form class="cart woocommerce-add-cart-form"
                                    id="formSave"
                                    action="{{ route('front.shop.add-to-cart', $product->id)}}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id}}">
                                    <input type="hidden" name="cart_token" id="cart_token">
                                    <div class="quantity buttons_added"><button type="button" class="minus"><i
                                                class="freshio-icon-angle-down"></i></button>
                                        <input type="number" id="quantity_64ecc73084439" class="input-text qty text"
                                            step="1" min="1" max="" name="quantity" value="1"
                                            title="Cantidad" size="4" placeholder="" inputmode="numeric"
                                            autocomplete="off"><button type="button" class="plus"><i
                                                class="freshio-icon-angle-up"></i></button>
                                    </div>
                                    <button type="submit" name="add-to-cart" value="{{ $product->id }}"
                                        class="single_add_to_cart_button button alt wp-element-button">Agregar al carrito</button>
                                </form>
                                
                            </div>
                        </div>
                        
                        <section class="up-sells upsells products">
                            <h2 class="text-blue-tono">Productos que te podrían gustar…</h2>
                            <ul class="products columns-4">
                                @foreach ($productsBeLink->items as $item)    
                                    <li
                                        class="product type-product post-{{ $item->id }} status-publish first instock product_cat-uncategorized product_cat-package-foods has-post-thumbnail sold-individually shipping-taxable product-type-grouped">
                                        <div class="product-block">
                                            <div class="product-transition">
                                                <div class="product-image"><img width="450" height="420"
                                                        src="{{ $item->url_image }}"
                                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                        alt="" decoding="async"></div>
                                                <div class="group-action">
                                                    <div class="shop-action">
                                                        <button class="woosw-btn btn-add-favorites woosw-btn-{{ $item->id }}" data-id="{{ $item->id }}"
                                                            data-product_name="Aerodynamic Linen Knife"
                                                            data-product_image="{{ $item->url_image }}">Agregar a favorito</button>
                                                            <a
                                                            href="{{ route('front.shop.show', $item->id) }}"
                                                            class="woosq-btn woosq-btn-{{ $item->id }}" data-id="{{ $item->id }}"
                                                            data-effect="mfp-3d-unfold" data-context="default">Ver</a>
                                                    </div>
                                                </div>
                                                <a href="{{ route('front.shop.show', $item->id) }}"
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link"></a>
                                            </div>
                                            <h3 class="woocommerce-loop-product__title"><a
                                                    href="{{ route('front.shop.show', $item->id) }}">{{ $item->name }}</a></h3>
                                            <span class="price"><span class="woocommerce-Price-amount amount"><bdi>
                                                <span class="woocommerce-Price-currencySymbol">$</span>{{ $item->price_format }}</bdi></span>
                                                <a href="{{ route('front.shop.show', $item->id) }}" data-quantity="1"
                                                    class="button wp-element-button product_type_variable add_to_cart_button "
                                                    data-product_id="{{ $item->id }}" data-product_sku="ergonomic-concrete-lamp-52303043"
                                                    aria-label="Select options for “{{ $item->name }}”" rel="nofollow"><span class="text-blue-tono">Ver producto</span> <span class="text-blue-tono ml-10px"><i class="fas fa-forward"></i></span></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>
                </main>
            </div>
        </div>
    </div>

    @include('front.includes.footer-hojas')

@endsection


@section('scripts_body_before')
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" aria-label="Share"></button>
                    <button class="pswp__button pswp__button--fs" aria-label="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>
                <button class="pswp__button pswp__button--arrow--right" aria-label="Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>


@endsection
{{-- After --}}
@section('scripts_body_after')
    {{-- @include('front.pages.shop.script-add-favorites') --}}
    <script src="{{ asset('scripts/common/quantity.js')}}"></script>
    <script>
        jQuery( function( $ ) {
            /**
             * Handle cart form submit and route to correct logic.
             *
             * @param {Object} evt The JQuery event
             */
            function cartAddProduct( evt ) {
                var $submit  = $( document.activeElement ),
                    $clicked = $( ':input[type=submit][clicked=true]' ),
                    $form    = $( evt.currentTarget );
    
                // For submit events, currentTarget is form.
                // For keypress events, currentTarget is input.
                if ( ! $form.is( 'form' ) ) {
                    $form = $( evt.currentTarget ).parents( 'form' );
                }
    
                // if ( 0 === $form.find( '.woocommerce-cart-form__contents' ).length ) {
                //     return;
                // }
    
                if ( is_blocked( $form ) ) {
                    return false;
                }
                block($form)
    
                evt.preventDefault();
                var tokenCart = localStorage.getItem('tokenCart');
                if(tokenCart){
                    $('#cart_token').val(tokenCart);
                }
                // Ajax element
                $.easyAjax({
                    url: '{{ route('front.cart.add-item') }}',
                    container: '#formSave',
                    type: 'POST',
                    redirect: false,
                    file: true,
                    data: $('#formSave').serialize(),
                    success: (response) => {
                        if (response.message) {
                            if (response.action === 'error') {
                                $.notify(
                                    response.message, 
                                    { position:"bottom right",className:"warn" }
                                );    
                            } else {
                                $.notify(
                                    response.message, 
                                    { position:"bottom right",className:"success" }
                                );
                            }
                        }
                        if(response.tokenCart){
                            localStorage.setItem('tokenCart', response.tokenCart);
                        }
                        unblock($form);
                        if(window.loadCartFloat){
                            window.loadCartFloat()
                        }
                    },
                    error: function(error) {
                        notifyErrorGlobal(error);
                        unblock($form);
                    }
                });
            }
            $( document ).on('submit','.woocommerce-add-cart-form', cartAddProduct );
        });
    </script>
@endsection