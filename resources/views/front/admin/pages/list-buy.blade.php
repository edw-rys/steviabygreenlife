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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles/auth/style.css') }}">
    @include('front.includes.head-shop')
@endsection


@section('scripts_body_last')
    <script>
        /**
         * Remove a item 
         */
        function changeStatusDelivery(cart_id, status_id, el_id) {
            block($('#'+ el_id))
            $.easyAjax({
                url: '{{ route('admin.delivery.change.status') }}',
                type: "PUT",
                data: {
                    _token: '{{ csrf_token() }}',
                    cart_id: cart_id,
                    status_id: status_id,
                },
                redirect: false,
                success: function(response) {
                    if (response.message) {
                        $.notify(
                            response.message, 
                            { position:"bottom right",className:"success" }
                        );
                    }
                    unblock($('#'+el_id));
                    $('#'+el_id).replaceWith(response.cart_html)
                    $('.select2').select2();
                },
                error: function(error) {
                    unblock($('#'+ el_id));
                    notifyErrorGlobal(error);
                },
            });
        }
        $('.select2').select2();
    </script>
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
                                        @include('front.admin.pages.shop.filters')
                                        <div class="card-body" style="    padding-left: 5px;padding-right: 5px;">
                                            @forelse($purcharses as $cart)
                                                @include('front.admin.pages.shop.item-buy-card')
                                            @empty
                                                <p>No se encontraron compras</p>
                                            @endforelse
                                            {{ $purcharses->appends(request()->input())->links() }}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    @include('front.pages.shop.script-add-favorites')
@endsection
