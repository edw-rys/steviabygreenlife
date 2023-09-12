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
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('styles/auth/style.css') }}"> --}}
    <style>
        .btn.btn-sm {
            padding: 0.1rem 0.4rem;
            font-size: 12px;
        }
    </style>
    @include('front.includes.head-shop')
@endsection

@section('scripts_body_last')
    <script>
        /**
         * Remove a item 
         */
        function removeCode(code_id) {
            if (!confirm('¿Está seguro de continuar con esta acción?')) {
                return;
            }
            var url = '{{ route('admin.discount.delete-code', ':id') }}';
            url = url.replace(':id', code_id);

            block($('#table-discount-codes'))
            $.easyAjax({
                url: url,
                type: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: code_id
                },
                redirect: true,
                error: function(error) {
                    unblock($('#table-discount-codes'));
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
                                            <a href="{{ route('admin.discount.create')}}">Agregar un nuevo código</a></p>
                                            @if ($discounts->isNotEmpty())
                                                <table class="table" style="border-collapse: collapse" border="1" id="table-discount-codes">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Porcentaje de descuento</th>
                                                            <th>Expirado el</th>
                                                            <th>Cantidad máxima de activaciones</th>
                                                            <th>Número de activaciones</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($discounts as $discount)
                                                            <tr>
                                                                <td>
                                                                    @if ($discount->deleted_at != null)
                                                                        <del>{{ $discount->code }}</del>
                                                                    @else
                                                                        {{ $discount->code }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-right">
                                                                    @if ($discount->deleted_at != null)
                                                                        <del>{{ $discount->percentage_discount}}%</del>
                                                                    @else
                                                                        {{ $discount->percentage_discount}}%
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($discount->deleted_at != null)
                                                                        <del>Eliminado</del>
                                                                    @else
                                                                        {{ $discount->expires == 1 && $discount->expired_at != null ? $discount->expired_at->format('d/m/Y') : 'No expira'}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($discount->deleted_at != null)
                                                                        <del>Eliminado</del>
                                                                    @else
                                                                        {{ $discount->attemps == '-1' ? 'Ilimitados' : $discount->attemps}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($discount->users_used > 0)
                                                                    <a href="{{ route('admin.shopping')}}?discount-code={{ $discount->code }}">{{ $discount->users_used }}</a>
                                                                    @else
                                                                    {{ $discount->users_used }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($discount->deleted_at == null)
                                                                        <button onclick="removeCode({{ $discount->id }})" class="btn btn-danger btn-sm">Eliminar</button>
                                                                    @else
                                                                        <small>Registro eliminado</small>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p>No hay lista de descuentos, <a href="{{ route('admin.discount.create')}}">crear un nuevo código</a></p>
                                            @endif
                                            @forelse($discounts as $discount)
                                            @empty
                                            @endforelse
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
