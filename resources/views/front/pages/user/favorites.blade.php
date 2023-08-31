@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
theme archive post-type-archive post-type-archive-product wp-embed-responsive theme-freshio woocommerce-shop woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-archive-product freshio-sidebar-left freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit @endsection
{{-- class-body-templateproduct-template-default single single-product postid-285 wp-embed-responsive theme-freshio woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-full-width-content freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit @endsection --}}
{{-- End class rename --}}


@section('head-content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles/auth/style.css')}}">
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
                    @if (session('title_success'))
                        <div class="woocommerce-message" role="alert"> {{session('title_success')}} </div>
                        {{ session()->forget('title_success') }}  
                    @endif
                    @if (session('title_error'))
                        <div class="woocommerce-message" style="background: rgb(227, 13, 13)" role="alert"> {{session('title_error')}} </div>
                        {{ session()->forget('title_error') }}  
                    @endif
                    <section class="section">
                        <div class="container mt-5">
                          <div class="row">
                            <div class="col-12">
                                {{-- <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-5 offset-xl-3"> --}}
                              <div class="card card-primary">
                                <div class="card-header"><h4>Favoritos</h4></div>
                    
                                <div class="card-body">
                                    @include('front.pages.shop.list-products')
                                    
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
    <script src="{{ asset('scripts/off-canvas.js')}}"></script>
    @include('front.pages.shop.script-add-favorites')
@endsection