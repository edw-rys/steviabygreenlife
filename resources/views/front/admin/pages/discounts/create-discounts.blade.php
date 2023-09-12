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
        function storeCodes(event) {
            event.preventDefault();
            block($('#form-store-codes'))
            $.easyAjax({
                url: '{{ route('admin.discount.store-code') }}',
                container: '#form-store-codes',
                type: "POST",
                data: $('#form-store-codes').serialize(),
                redirect: true,
                error: function(error) {
                    unblock($('#form-store-codes'));
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
                                        <div class="card-body" style="padding-left: 5px;padding-right: 5px;">
                                            <form method="POST" action="{{ route('admin.discount.store-code') }}" id="form-store-codes" class="needs-validation row" novalidate="" onsubmit="storeCodes(event)">
                                                @csrf 
                                                {{-- Code --}}
                                                <div class="form-group col-md-6 col-12">
                                                        <label class="control-label">Código <span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="code" required value="{{ old('code') }}">
                                                    {!!$errors->first("code", "<span class='text-danger'>:message</span>")!!}
                                                </div>

                                                <div class="form-group col-md-6 col-12">
                                                    <label class="control-label">Porcentaje de descuento <span class="required">*</span></label>
                                                    <input type="number" class="form-control" name="percentage_discount" required value="{{ old('percentage_discount') }}">
                                                    {!!$errors->first("percentage_discount", "<span class='text-danger'>:message</span>")!!}
                                                </div>

                                                <div class="form-group col-md-6 col-12">
                                                    <label class="control-label" for="expires-label">¿El código expira?</label>
                                                    <input type="checkbox" class="form-check-label" name="expires" id="expires-label" onchange="$('#field-expired_at').toggleClass('hidden')">
                                                </div>
                                                
                                                <div class="form-group col-md-6 col-12 hidden" id="field-expired_at">
                                                    <label class="control-label">Fecha de expiración <span class="required">*</span></label>
                                                    <input type="date" class="form-control" name="expired_at" value="{{ old('expired_at') }}">
                                                    {!!$errors->first("expired_at", "<span class='text-danger'>:message</span>")!!}
                                                </div>
                                                
                                                <div class="form-group col-md-6 col-12">
                                                    <label class="control-label" for="attemps-enable-label">Controlar cantidad de activaciones</label>
                                                    <input type="checkbox" class="form-check-label" name="attemps-enable" id="attemps-enable-label" onchange="$('#field-attemps').toggleClass('hidden')">
                                                </div>

                                                <div class="form-group col-md-6 col-12 hidden" id="field-attemps">
                                                    <label class="control-label">Cantidad de activaciones permitidas <span class="required">*</span></label>
                                                    <input type="number" class="form-control" name="attemps" value="{{ old('attemps') }}">
                                                    {!!$errors->first("attemps", "<span class='text-danger'>:message</span>")!!}
                                                </div>
        
                                                <div class="form-group col-12">
                                                    <button type="submit" class="btn btn-primary btn-sm ">
                                                        Guardar datos
                                                    </button>
                                                </div>
                                            </form>
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
