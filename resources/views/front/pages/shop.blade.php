@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
theme archive post-type-archive post-type-archive-product wp-embed-responsive theme-freshio woocommerce-shop woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-archive-product freshio-sidebar-left freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit @endsection
{{-- End class rename --}}
@section('head-content')
    @include('front.includes.head-shop')
@endsection
@section('main-content')

    @include('front.pages.shop.header')
    @include('front.pages.shop.banner')
    @include('front.pages.shop.products')
    @endsection
    
@section('scripts_body_after')
    <script src="{{ asset('scripts/off-canvas.js')}}"></script>
@endsection