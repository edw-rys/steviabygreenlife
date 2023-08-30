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
    <div class="freshio-breadcrumb" style="background: #00BAB4;color:white">
        <div class="col-full">
            <h1 class="breadcrumb-heading">
                {{ $product->name }} </h1>
            <nav class="woocommerce-breadcrumb" style="color:white">
                <a style="color:white" href="{{ route('front.shop')}}">Inicio</a>
                @if ($product->category != null)
                    <span style="color:white" class="breadcrumb-separator"> / </span><a style="color:white" href="{{ route('front.shop.category', $product->category->system_name)}}">{{ $product->category->name }}</a>
                @endif
                <span style="color:white" class="breadcrumb-separator"> / </span> {{ $product->name }}
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
                    <div id="product-264"
                        class="product type-product post-264 status-publish first instock product_cat-uncategorized product_cat-package-foods has-post-thumbnail shipping-taxable purchasable product-type-simple">
                        <div class="content-single-wrapper">
                            <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images woocommerce-product-gallery-horizontal"
                                data-columns="4" style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;"><a
                                    href="#" class="woocommerce-product-gallery__trigger"><img draggable="false"
                                        role="img" class="emoji" alt="🔍"
                                        src="{{ asset('images/shop/1f50d.svg')}}"></a>
                                <figure class="woocommerce-product-gallery__wrapper">
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
                            <div class="summary entry-summary">
                                <span class="inventory_status">En Stock</span>
                                <h2 class="product_title entry-title">
                                    {{ $product->name }}</h2>
                                <p class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $product->price_format}}</bdi></span></p>
                                <div class="woocommerce-product-details__short-description">
                                    {!! $product->description !!}
                                </div>
                                <form class="cart"
                                    action="{{ route('front.shop.add-to-cart', $product->id)}}"
                                    method="post" enctype="multipart/form-data">
                                    <div class="quantity buttons_added"><button type="button" class="minus"><i
                                                class="freshio-icon-angle-down"></i></button>
                                        <input type="number" id="quantity_64ecc73084439" class="input-text qty text"
                                            step="1" min="1" max="" name="quantity" value="1"
                                            title="Cantidad" size="4" placeholder="" inputmode="numeric"
                                            autocomplete="off"><button type="button" class="plus"><i
                                                class="freshio-icon-angle-up"></i></button>
                                    </div>
                                    <button type="submit" name="add-to-cart" value="264"
                                        class="single_add_to_cart_button button alt wp-element-button">Agregar al carrito</button>
                                </form>
                                
                            </div>
                        </div>
                        
                        <section class="up-sells upsells products">
                            <h2>Productos que te podrían gustar…</h2>
                            <ul class="products columns-4">
                                @foreach ($productsBeLink->items as $item)    
                                    <li
                                        class="product type-product post-262 status-publish first instock product_cat-uncategorized product_cat-package-foods has-post-thumbnail sold-individually shipping-taxable product-type-grouped">
                                        <div class="product-block">
                                            <div class="product-transition">
                                                <div class="product-image"><img width="450" height="420"
                                                        src="{{ $item->url_image }}"
                                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                        alt="" decoding="async"></div>
                                                <div class="group-action">
                                                    <div class="shop-action">
                                                        <button class="woosw-btn woosw-btn-262" data-id="262"
                                                            data-product_name="Aerodynamic Linen Knife"
                                                            data-product_image="{{ $item->url_image }}">Add
                                                            to wishlist</button><button class="woosc-btn woosc-btn-262 "
                                                            data-id="262" data-product_name="Aerodynamic Linen Knife"
                                                            data-product_image="{{ $item->url_image }}">Compare</button><button
                                                            class="woosq-btn woosq-btn-262" data-id="262"
                                                            data-effect="mfp-3d-unfold" data-context="default">Quick
                                                            view</button>
                                                    </div>
                                                </div>
                                                <a href="{{ route('front.shop.show', $item->id) }}"
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link"></a>
                                            </div>
                                            <h3 class="woocommerce-loop-product__title"><a
                                                    href="{{ route('front.shop.show', $item->id) }}">{{ $item->name }}</a></h3>
                                            <span class="price"><span class="woocommerce-Price-amount amount"><bdi><span
                                                            class="woocommerce-Price-currencySymbol">$</span>{{ $item->price_format }}</bdi></span>
                                            <a href="{{ route('front.shop.show', $item->id) }}"
                                                data-quantity="1" class="button wp-element-button product_type_grouped"
                                                data-product_id="262" data-product_sku="aerodynamic-linen-knife-74234493"
                                                aria-label="Ver productos en el grupo “{{ $item->name }}"
                                                rel="nofollow">Ver producto</a>
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

@endsection