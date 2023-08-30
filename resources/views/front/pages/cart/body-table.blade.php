@foreach ($productsShop as $product)
    <tr class="woocommerce-cart-form__cart-item cart_item">

        <td class="product-remove">
            <span onclick="removeItemShop($prod)" 
                class="remove" aria-label="Remove this item" data-product_id="266"
                data-product_sku="durable-aluminum-shoes-62990271">×</span>
        </td>

        <td class="product-thumbnail">
            <a href="https://demo2.pavothemes.com/freshio/product/durable-aluminum-shoes/"><img width="450"
                    height="420" src="{{ $product->url_image }}"
                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""
                    decoding="async"></a>
        </td>

        <td class="product-name" data-title="Product">
            <a href="https://demo2.pavothemes.com/freshio/product/durable-aluminum-shoes/">Durable
                Aluminum Shoes</a>
        </td>

        <td class="product-price" data-title="Price">
            <span class="woocommerce-Price-amount amount"><bdi><span
                        class="woocommerce-Price-currencySymbol">£</span>366.90</bdi></span>
        </td>

        <td class="product-quantity" data-title="Quantity">
            <div class="quantity">
                <label class="screen-reader-text" for="quantity_64ed187aef1a4">Durable Aluminum Shoes
                    quantity</label>
                <input type="number" id="quantity_64ed187aef1a4" class="input-text qty text" step="1"
                    min="0" max="97" name="cart[f7664060cc52bc6f3d620bcedc94a4b6][qty]" value="2"
                    title="Qty" size="4" placeholder="" inputmode="numeric" autocomplete="off">
            </div>
        </td>

        <td class="product-subtotal" data-title="Subtotal">
            <span class="woocommerce-Price-amount amount"><bdi><span
                        class="woocommerce-Price-currencySymbol">£</span>733.80</bdi></span>
        </td>
    </tr>
@endforeach
