<h3 id="order_review_heading">Su orden</h3>
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
                            class="product-quantity">×&nbsp;{{ $productCart->count }}</strong> </td>
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

            {{-- <tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        <td><span class="woocommerce-Price-amount amount"><bdi><span
                                                                        class="woocommerce-Price-currencySymbol">£</span>3,063.75</bdi></span>
                                                        </td>
                                                    </tr> --}}

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
<div id="payment" class="woocommerce-checkout-payment">
    {{-- <ul class="wc_payment_methods payment_methods methods">
                                                <li class="woocommerce-notice woocommerce-notice--info woocommerce-info">
                                                    <span
                                                        class="woocommerce-no-available-payment-methods-message e-description">Sorry,
                                                        it seems that there are no available payment methods for your state.
                                                        Please contact us if you require assistance or wish to make
                                                        alternate arrangements.</span></li>
                                            </ul> --}}
    <div class="form-row place-order">

        <div class="woocommerce-terms-and-conditions-wrapper">
            <div class="woocommerce-privacy-policy-text">
                <p>Sus datos personales se utilizarán para procesar su pedido, respaldar su experiencia en este sitio
                    web y para otros fines descritos en nuestra <a href="{{ route('front.terms') }}"
                        class="woocommerce-privacy-policy-link" target="_blank">política y privacidad</a>.</p>
            </div>
        </div>


        <button type="submit" class="button alt wp-element-button" name="woocommerce_checkout_place_order"
            id="place_order" value="Place order" data-value="Place order">Realizar pedido</button>

        <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce"
            value="20b3632201"><input type="hidden" name="_wp_http_referer"
            value="/freshio/?wc-ajax=update_order_review&amp;elementor_page_id=77">
    </div>
</div>
