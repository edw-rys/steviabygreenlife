@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
    theme archive post-type-archive post-type-archive-product wp-embed-responsive theme-freshio woocommerce-shop woocommerce
    woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip
    chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1
    freshio-archive-product freshio-sidebar-left freshio-product-tablet-3 freshio-product-mobile-2 single-product-1
    freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit
@endsection
{{-- class-body-templateproduct-template-default single single-product postid-285 wp-embed-responsive theme-freshio woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-full-width-content freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit @endsection --}}
{{-- End class rename --}}


@section('head-content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles/auth/style.css') }}">
    @include('front.includes.head-shop')
@endsection
@section('main-content')
    @include('front.pages.shop.header')

    {{-- form --}}
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div class="woocommerce"></div>
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <header class="woocommerce-products-header">
                    </header>
                    <div class="woocommerce-notices-wrapper"></div>


                    {{-- form --}}
                    <section class="section">
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-12">
                                    {{-- <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-5 offset-xl-3"> --}}
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4>Mis compras</h4>
                                        </div>

                                        <div class="card-body" style="    padding-left: 5px;padding-right: 5px;">
                                            @forelse($purcharses as $cart)
                                                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-b324434"
                                                    data-id="b324434" data-element_type="column">
                                                    <div class="elementor-column-wrap elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            
                                                            <div class="elementor-element elementor-element-7ade6a3 elementor-widget-mobile__width-inherit elementor-widget elementor-widget-heading"
                                                                data-id="7ade6a3" data-element_type="widget"
                                                                data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h3 class="elementor-heading-title elementor-size-default"> <a href="{{ route('front.result.pay', base64_encode($cart->transaction_code))}}">Pedido # {{ $cart->numero_pedido}} realizado el: {{$cart->created_at_format }}</a></h3>
                                                                </div>
                                                            </div>
                                                            <div class="elementor-element elementor-element-adc11cd elementor-widget__width-initial elementor-widget-tablet__width-inherit elementor-widget elementor-widget-text-editor"
                                                                data-id="adc11cd" data-element_type="widget"
                                                                data-widget_type="text-editor.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="elementor-text-editor elementor-clearfix">Enviar a: <strong>{{ $cart->billing->country->name ?? '-'}}-{{ $cart->billing->state->name ?? '-'}}-{{ $cart->billing->city->name ?? '-'}}</strong></div>
                                                                </div>
                                                            </div>
                                                            <div class="elementor-element elementor-element-d91d3b4 elementor-widget elementor-widget-freshio-single-product"
                                                                data-id="d91d3b4" data-element_type="widget"
                                                                data-widget_type="freshio-single-product.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="freshio-elementor-single-product">
                                                                        <div class="woosb-wrap woosb-bundled"
                                                                            data-id="275">
                                                                            <div class="woosb-products">
                                                                                @foreach ($cart->products as $item)
                                                                                    <div class="woosb-product"
                                                                                        data-name="Heavy Duty Paper Computer"
                                                                                        data-price-suffix=""
                                                                                        data-order="1">
                                                                                        <div class="woosb-thumb">
                                                                                            <a
                                                                                                href="{{ route('front.shop.show', $item->product_id) }}">
                                                                                                <div class="woosb-thumb-ori">
                                                                                                    <img width="450"
                                                                                                        height="420"
                                                                                                        src="{{ $item->url_image }}"
                                                                                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazyloaded"
                                                                                                        alt=""
                                                                                                        decoding="async"
                                                                                                        data-ll-status="loaded"><noscript><img
                                                                                                            width="450"
                                                                                                            height="420"
                                                                                                            src="{{ $item->url_image }}"
                                                                                                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                                                                            alt=""
                                                                                                            decoding="async" /></noscript>
                                                                                                </div>
                                                                                                <div class="woosb-thumb-new">
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="woosb-title">
                                                                                            <div class="woosb-title-inner">
                                                                                                <a href="{{ route('front.shop.show', $item->product_id) }}">{{ $item->name}}</a>
                                                                                                <span> <strong> ({{ $item->count}} items)</strong></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="woosb-price">
                                                                                            <div class="woosb-price-ori">
                                                                                                <span class="woocommerce-Price-amount amount"><bdi>
                                                                                                    <span class="woocommerce-Price-currencySymbol">$</span> {{ $item->total_format}}</bdi></span>
                                                                                            </div>
                                                                                            <div class="woosb-price-new"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                                <div class="m-0 woosb-product"> 
                                                                                    <div class="woosb-title">
                                                                                        <div class="woosb-title-inner">
                                                                                            Costo de envío
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="woosb-price">
                                                                                        <div class="woosb-price-ori">
                                                                                            <span class="woocommerce-Price-amount amount"><bdi>
                                                                                                <span class="woocommerce-Price-currencySymbol">$</span> {{ $cart->delivery_cost_format }}</bdi></span>
                                                                                        </div>
                                                                                        <div class="woosb-price-new"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="woosb-total woosb-text">Costo total + envío: <span
                                                                                    class="woocommerce-Price-amount amount"><span
                                                                                        class="woocommerce-Price-currencySymbol">$</span>{{ $cart->total_more_delivery_format }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>No se encontraron compras
                                            @endforelse
                                            {{ $purcharses->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </main>
            </div>
            @include('front.pages.user.options-menu')
        </div>
    </div>
@endsection

@section('scripts_body_after')
    <script src="{{ asset('scripts/off-canvas.js') }}"></script>
    @include('front.pages.shop.script-add-favorites')
@endsection
