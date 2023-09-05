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
        #order_review {
            float: initial !important;
            margin: 0 auto;
        }

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
