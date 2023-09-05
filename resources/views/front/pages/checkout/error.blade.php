@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
error404 wp-embed-responsive theme-freshio woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-freshio wvs-show-label wvs-tooltip chrome product-hover-default freshio-layout-wide woocommerce-active product-style-1 single-product-1 freshio-footer-builder elementor-default elementor-kit-7 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit
@endsection
{{-- End class rename --}}

@section('head-content')
    @include('front.includes.head-shop')
@endsection

{{-- Scripts --}}
@section('scripts_body_after')
@endsection

@section('main-content')
    @include('front.pages.shop.header')


    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div class="woocommerce"></div>
            <div id="primary" class="content">
                <main id="main" class="site-main" role="main">
                    <div class="error-404 not-found">
                        <div class="page-content text-center">
                            <header class="page-header">
                                <div class="error-img404">
                                    <img src="{{ asset('images/shop/tomate.png')}}"
                                        alt="404 Page">
                                </div>
                                <h1 class="page-title">Oops, algo ha salido mal.</h1>
                            </header>
                            <div class="error-text">
                                <span>Por favor, vuelva a intentar más luego</span>
                                <br>
                                <a href="{{ route('front.shop')}}" class="return-home">Volver al e-comerce</a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
