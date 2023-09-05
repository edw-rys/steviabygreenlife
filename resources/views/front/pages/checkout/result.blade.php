@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
    page-template-default page page-id-75 wp-embed-responsive theme-freshio woocommerce-cart woocommerce-page woocommerce-js
    woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default
    freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2
    single-product-1 freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome
    e--ua-webkit
@endsection
{{-- End class rename --}}

@section('head-content')
    @include('front.includes.head-shop')
    <style>
        /* #order_review {
            float: initial !important;
            margin: 0 auto;
        } */

        ._failed {
            border-bottom: solid 4px red !important;
        }

        ._failed i {
            color: red !important;
        }

        ._success {
            box-shadow: 0 15px 25px #00000019;
            padding: 28px;
            width: 100%;
            text-align: center;
            margin: 20px auto;
            border-bottom: solid 4px #28a745;
        }

        ._success i {
            font-size: 55px;
            color: #28a745;
        }

        ._success h2 {
            margin-bottom: 12px;
            /* font-size: 40px; */
            font-weight: 500;
            /* line-height: 1.2; */
            margin-top: 10px;
        }

        ._success p {
            margin-bottom: 0px;
            font-size: 18px;
            color: #495057;
            font-weight: 500;
        }
        .bold{
            font-weight: 900;
        }
    </style>
@endsection

{{-- Scripts --}}
@section('scripts_body_after')
@if($remove_token == 'yes')
<script>
    localStorage.removeItem(enviropments.cartTokenStorage);
</script>
@endif
@endsection

@section('scripts_body_last')
    @if (auth()->check() && auth()->user()->hasRole(getAdminName()))
        <script>
            /**
             * Remove a item 
             */
            function cancelOrder() {
                if (!confirm('¿Está seguro/a de continuar con la cancelación de la orden?')) {
                    return;
                }
                block($('#order_review'))
                $.easyAjax({
                    url: '{{ route('admin.cancel.order', $cart->id) }}',
                    type: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        cart_id: '{{ $cart->id }}'
                    },
                    redirect: false,
                    success: function(response) {
                        if (response.message) {
                            $.notify(
                                response.message, 
                                { position:"bottom right",className:"success" }
                            );
                        }
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                        unblock($('#order_review'));
                    },
                    error: function(error) {
                        unblock($('#order_review'));
                        notifyErrorGlobal(error);
                    },
                });
            }
        </script>
    @endif
@endsection

@section('main-content')
    @include('front.pages.shop.header')
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div id="primary">
                <main id="main" class="site-main" role="main">
                    <article id="post-77" class="post-77 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper"></div>

                                <div class="col2-set" id="customer_details">
                                    <div class="col-1">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Datos de facturación para pedido # {{$cart->numero_pedido}}</h3>
                                            <span class="badge {{ badgeStatusStore($cart->status) }}" style="font-size: 13px;padding: 7px;"> @lang('global.status-label.'. ( $cart->status ?? 'in-process'))</span>
                                            <div class="woocommerce-billing-fields__field-wrapper">
                                                <p class="form-row form-row-first validate-required" data-priority="10">
                                                    <label class="bold">Nombres: </label>
                                                    {{ $cart->billing->name }}
                                                </p>
                                                <p class="form-row form-row-last validate-required" data-priority="20">
                                                    <label class="bold">Apelllidos&nbsp;</label>
                                                    <span class="woocommerce-input-wrapper">
                                                        {{ $cart->billing->last_name }}
                                                    </span>
                                                </p>
                                                
                                                
                                                {{-- Company name --}}
                                                <p class="form-row @if ($cart->billing->business_name) form-row-first @else form-row-wide @endif" id="billing_identification_number_field" data-priority="30">
                                                    <label class="bold">Cédula&nbsp;</label>
                                                    <span class="woocommerce-input-wrapper">
                                                        {{ $cart->billing->identification_number }}
                                                    </span>
                                                </p>
                                                @if ($cart->billing->business_name)
                                                    {{-- Company name --}}
                                                    <p class="form-row form-row-last" id="billing_company_field" data-priority="30">
                                                        <label  class="bold">Nombre de la compañía&nbsp;</label>
                                                        <span class="woocommerce-input-wrapper">
                                                            {{$cart->billing->business_name}}
                                                        </span>
                                                    </p>
                                                @endif
                                                <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="40">
                                                    <label class="bold">País:</label>
                                                    <span>
                                                        {{ $cart->billing->country->name ?? '-' }}
                                                    </span>
                                                </p>
                                                {{-- states --}}
                                                <p class="form-row form-row-first address-field update_totals_on_change validate-required" data-priority="40">
                                                    <label class="bold">Provincia&nbsp;</label>
                                                    <span class="woocommerce-input-wrapper">
                                                        {{ $cart->billing->state->name ?? '-' }}
                                                    </span>
                                                </p>

                                                {{-- cities --}}
                                                <p class="form-row form-row-last address-field update_totals_on_change validate-required" data-priority="40">
                                                    <label class="bold">Ciudad&nbsp;</label>
                                                    <span class="woocommerce-input-wrapper">
                                                        {{ $cart->billing->city->name ?? '-' }}
                                                    </span>
                                                </p>
                                                {{-- Address --}}
                                                <p class="form-row address-field validate-required @if ($cart->billing->apartamento) form-row-wide @else form-row-first @endif" data-priority="50">
                                                    <label class="bold">Dirección&nbsp;</label>
                                                    <span class="woocommerce-input-wrapper">
                                                        {{ $cart->billing->address }}
                                                    </span>
                                                </p>
                                                @if ($cart->billing->apartamento)
                                                    {{-- Apartamento --}}
                                                    <p class="form-row address-field form-row-first" data-priority="60">
                                                        <label  class="bold">Apartamento, suite, unidad, etc.&nbsp;</label>
                                                        <span class="woocommerce-input-wrapper">
                                                            {{ $cart->billing->apartamento }}
                                                        </span>
                                                    </p>
                                                    
                                                @endif
                                                {{-- Postal code --}}
                                                <p class="form-row address-field form-row-last" data-priority="90" >
                                                    <label class="bold">Código Postal &nbsp;</label>
                                                    <span class="woocommerce-input-wrapper">
                                                        {{ $cart->billing->postal_code }}
                                                    </span>
                                                </p>
                                                {{-- Phone --}}
                                                <p class="form-row form-row-first validate-required validate-phone" data-priority="100">
                                                    <label class="bold">Celular&nbsp;</label>
                                                    <span class="woocommerce-input-wrapper">
                                                        {{ $cart->billing->phone }}
                                                    </span>
                                                </p>
                                                {{-- Email --}}
                                                <p class="form-row form-row-last validate-required validate-email" data-priority="110">
                                                    <label class="bold">Dirección de correo electrónico&nbsp;</label>
                                                    <span class="woocommerce-input-wrapper">
                                                        {{ $cart->billing->email }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @if ( $cart->billing->aditional_info )
                                        <div class="col-2">
                                            <div class="woocommerce-shipping-fields">
                                            </div>
                                            <div class="woocommerce-additional-fields">
                                                <h3>Información adicional</h3>
                                                <div class="woocommerce-additional-fields__field-wrapper">
                                                    <p class="form-row notes" id="order_comments_field" data-priority="">
                                                        <label class="bold">Notas sobre la entrega&nbsp;</label><span
                                                            class="woocommerce-input-wrapper">
                                                            {{ $cart->billing->aditional_info }}
                                                        </span></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div id="order_review" class="woocommerce-checkout-review-order">
                                    {{-- <h3 id="order_review_heading">Su orden</h3> --}}
                                    @if ($transaction->status_pay_code == 3)
                                        <div class="row justify-content-center">
                                            <div class="col-md-5">
                                                <div class="message-box _success">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                    <h3> Transacción Aprobada </h3>
                                                    <p>Gracias por su pago. estaremos <br> en contacto con más detalles en breve</p>      
                                                </div> 
                                            </div> 
                                        </div> 
                                    @else 
                                        @if ($transaction->status_pay_code == 2)
                                            <div class="row justify-content-center">
                                                <div class="col-md-5">
                                                    <div class="message-box _success _failed">
                                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                        <h3> Transacción {{ $transaction->message }} </h3>
                                                    </div> 
                                                </div> 
                                            </div> 
                                        @endif
                                    @endif
                                    <div class="checkout-review-order-table-wrapper">
                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Producto</th>
                                                    <th class="product-total">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cart->products as $productCart)
                                                    <tr class="cart_item">
                                                        <td class="product-name">
                                                            {{ $productCart->product->name }}&nbsp; <strong
                                                                class="product-quantity">×&nbsp;{{ $productCart->count }}</strong>
                                                        </td>
                                                        <td class="product-total">
                                                            <span class="woocommerce-Price-amount amount"><bdi><span
                                                                        class="woocommerce-Price-currencySymbol">$</span>{{ $productCart->total_format }}</bdi></span>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <tr class="cart_item">
                                                    <td class="product-name">Costo de envío</td>
                                                    <td class="product-total">
                                                        <span class="woocommerce-Price-amount amount"><bdi><span
                                                                    class="woocommerce-Price-currencySymbol">$</span><span
                                                                    id="billing-delivery-cost">{{ $cart->delivery_cost_format }}</span></bdi></span>
                                                    </td>
                                                </tr>

                                            </tbody>
                                            <tfoot>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td><strong><span class="woocommerce-Price-amount amount"><bdi><span
                                                                        class="woocommerce-Price-currencySymbol">$</span><span
                                                                        id="billing-total">{{ $cart->total_more_delivery_format }}</span></bdi></span></strong>
                                                    </td>
                                                </tr>


                                            </tfoot>
                                        </table>
                                        @if (auth()->check() && auth()->user()->hasRole(getAdminName()) && $cart->status != statusCancelled())
                                            <button onclick="cancelOrder()" class="btn btn-sm btn-danger">Cancelar pedido</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </main>
            </div>
        </div>
    </div>
@endsection
