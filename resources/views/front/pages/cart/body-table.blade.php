@if ($cart != null)
    @foreach ($cart->products as $productShop)
        <tr class="woocommerce-cart-form__cart-item cart_item">
            <td class="product-remove">
                <span onclick="removeItemShop('{{ $productShop->id }}')" 
                    style="cursor: pointer;border: 1px solid;border-radius: 100%;padding: 2px 4px;"
                    class="remove" aria-label="Remove this item" data-product_id="{{ $productShop->id }}"
                    data-product_sku="durable-aluminum-shoes-62990271">×</span>
            </td>

            <td class="product-thumbnail">
                <a href="{{ route('front.shop.show', $productShop->product->id)}}"><img width="450"
                    height="420" src="{{ $productShop->product->url_image }}"
                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""
                    decoding="async"></a>
            </td>

            <td class="product-name" data-title="Product">
                <a href="{{ route('front.shop.show', $productShop->product->id)}}">{{ $productShop->product->name }}</a>
            </td>

            <td class="product-price" data-title="Price">
                <span class="woocommerce-Price-amount amount"><bdi><span
                            class="woocommerce-Price-currencySymbol">$</span>{{ $productShop->price_format}}</bdi></span>
            </td>

            <td class="product-quantity" data-title="Quantity">
                <div class="quantity">
                    <label class="screen-reader-text" for="quantity_64ed187aef1a4">Cantidad de {{ $productShop->product->name }}</label>
                    <input type="hidden" name="cart_product[{{ $productShop->id }}][item_id]" value="{{ $productShop->id }}">
                    <input type="number" id="quantity_64ed187aef1a4" class="input-text qty text" step="1"
                        min="0" max="100" name="cart_product[{{ $productShop->id }}][qty]" value="{{ $productShop->count }}"
                        onchange="activeButtonRestartCart()"
                        title="Cantidad" size="4" placeholder="" inputmode="numeric" autocomplete="off">
                </div>
            </td>

            <td class="product-subtotal" data-title="Subtotal">
                <span class="woocommerce-Price-amount amount"><bdi><span
                            class="woocommerce-Price-currencySymbol">$</span>{{ $productShop->total_format }}</bdi></span>
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="5">
            <strong>Total a pagar</strong>
        </td>
        <td>
            <strong>$ {{ $cart->subtotal_before_discount_code_format }}</strong>
        </td>

    </tr>
    <tr>
        <td colspan="6" class="actions">
            @if (auth()->check() && $cart->discountCart == null)
                <div class="coupon">
                    <label for="coupon_code">Cupón:</label> <input type="text"
                        name="coupon_code" class="input-text" id="coupon_code"
                        value="" placeholder="Coupon code"> 
                    <button
                        type="button" class="button wp-element-button"
                        name="apply_coupon" value="Apply coupon"
                        onclick="applyDiscount()">Aplicar descuento</button>
                </div>
            @else 
                @if ($cart->discountCart != null)
                    <div class="coupon">
                        
                        <span><strong >Cupón: </strong>  {{$cart->discountCart->code}}<br> <strong>Descuento del: </strong>{{ $cart->discountCart->percentage_discount }}%</span>
                    </div>
                
                @endif
            @endif

            <button type="submit" class="button wp-element-button"
                name="update_cart" id="update_cart" value="Update cart" disabled=""
                aria-disabled="true">Actualizar carrito</button>


            <input type="hidden" id="woocommerce-cart-nonce"
                name="woocommerce-cart-nonce" value="306f616ba0"><input
                type="hidden" name="_wp_http_referer" value="/freshio/cart/">
        </td>
    </tr>
@else
    <tr class="woocommerce-cart-form__cart-item cart_item">
        <td colspan="5">
            <div>
                <p class="cart-empty woocommerce-info">Su carrito está vacío.</p>
                <p class="return-to-shop">
                    <a class="button wc-backward wp-element-button" href="{{ route('front.shop')}}">Regresar a la tienda</a>
                </p>

            </div>

        </td>
    </tr>
@endif
