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
            @if ($cart->discount_code && $cart->discountCart != null)
                <tr class="cart_item">
                    <td class="product-name">Descuento con cupón: <strong>{{ $cart->discountCart->code }}</strong></td>
                    <td class="product-total">
                        <span class="woocommerce-Price-amount amount"><bdi><span
                                    class="woocommerce-Price-currencySymbol" style="color: red">- $</span><span
                                    id="billing-delivery-cost" style="color: red">{{ $cart->discount_code_format }}</span></bdi></span>
                    </td>
                </tr>
            @endif

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
<div id="payment" class="woocommerce-checkout-payment">
    <div class="form-row place-order">

        <div class="woocommerce-terms-and-conditions-wrapper">
            <div class="woocommerce-privacy-policy-text">
                <p>Sus datos personales se utilizarán para procesar su pedido, respaldar su experiencia en este sitio
                    web y para otros fines descritos en nuestra <a href="{{ route('front.terms') }}"
                        class="woocommerce-privacy-policy-link" target="_blank">política y privacidad</a>.</p>
            </div>
        </div>
        @if (isset($process) && $process)
            <div id="process-to-checkout-methods" {{-- elements --}}>
                <ul class="wc_payment_methods payment_methods methods">
                    <li class="wc_payment_method payment_method_bacs">
                        <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked" data-order_button_text="">
                        <label for="payment_method_bacs">Transferencia bancaria directa 	</label>
                            <div class="payment_box payment_method_bacs">
                            <p>Realiza tu pago directamente en nuestra cuenta bancaria. Por favor, usa el número del pedido como referencia de pago. Tu pedido no se procesará hasta que se haya recibido el importe en nuestra cuenta.</p>
                        </div>
                    </li>
                    <li class="wc_payment_method payment_method_payphone">
                        <input id="payment_method_payphone" type="radio" class="input-radio" name="payment_method" value="payphone" data-order_button_text="">
                    
                        <label for="payment_method_payphone">Pagos con tarjeta de crédito y débito | Payphone <img src="{{ asset('images/shop/logo-woocommerce.png')}}" alt="Pagos con tarjeta de crédito y débito | Payphone">	</label>
                            <div class="payment_box payment_method_payphone" >
                            <p>Utilice sus tarjetas de crédito o débito Visa y Mastercard de cualquier banco y, si tiene la aplicación Payphone, utilice su saldo de Payphone.</p>
                        </div>
                    </li>
                </ul>
                <button class="button alt wp-element-button" type="button" onclick="processSelectMethodPayment()">Proceder </button>
            </div>
            <div id="mode-pay-transferencia" class="hidden">
                <a href="javascript:;" onclick="resetSelectMethodPayment()"><i class="fa fas fa-arrow-left"></i></a>
                <div>
                    <h5 class="text-center">Detalle de las cuentas</h5>
                </div>
                @foreach ($accountsBank as $bank)
                    <div>
                        <p style="margin: 0">
                            <strong>Nombre de la cuenta:</strong>
                            <span>{{ $bank->details }}</span>
                        </p>
                        <p style="margin: 0"> 
                            <strong>{{ $bank->type_account }} {{ $bank->bank_name }}:</strong>
                            <span>{{ $bank->number_account }}</span>
                        </p>
                        <p style="margin: 0">
                            <strong>Ruc:</strong>
                            <span>{{ config('app.shop_details.ruc') }}</span>
                        </p>
                        <p style="margin: 0">
                            <strong>Mail:</strong>
                            <span>{{ config('app.shop_details.mail') }}</span>
                        </p>
                        <br>
                    </div>
                @endforeach
                <div class="border-2 border-dashed dark:border-dark-5 rounded-md pt-4 ng-star-inserted"
                    style="margin-top: 10px;margin-bottom: 20px">
                    <h3 class="ml-1" style="margin: 0; padding-left: 20px;">Comprobantes de pago</h3>
                    <div class="pos__ticket box p-2 ng-star-inserted">
                        <div id="contentsFileUpload">
                        </div>

                        <input type="file" id="file-bank-comprobante" class="d-none hidden" onchange="changeFileComprobante(event)">
                        {{-- ADD FILE --}}
                        <a
                            onclick="addNewFile()"
                            id="add-file-transfer-btn"
                            href="javascript:;" data-toggle="modal"
                            class="item-image-photo  text-center">
                            <div class="pos__ticket__item-name truncate mr-1 border-dashed">
                                <span>Agregar archivo</span>
                                <i class="fa far fa-file"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" onclick="processToSolicitud()">Solicitar verificación</button>
                </div>
            </div>

            <div id="mode-pay-tc" class="hidden">
                <a href="javascript:;" onclick="resetSelectMethodPayment()"><i class="fa fas fa-arrow-left"></i></a>

                <div id="pp-button"></div>
            </div>
        @else
            <button type="submit" class="button alt wp-element-button" name="woocommerce_checkout_place_order"
                id="place_order" value="Place order" data-value="Place order">Realizar pedido</button>
        @endif

        {{-- <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce"
            value="20b3632201"><input type="hidden" name="_wp_http_referer"
            value="/freshio/?wc-ajax=update_order_review&amp;elementor_page_id=77"> --}}
    </div>
</div>
