<ul class="products columns-3">
    @foreach ($products->items as $item)
        <li
            class="product type-product post-267 status-publish first instock product_cat-dairy-bread-eggs product_cat-uncategorized has-post-thumbnail shipping-taxable purchasable product-type-variable">
            <div class="product-block">
                <div class="product-transition">
                    <div class="product-image">
                        <img width="450" height="420"
                            src="{{ $item->url_image }}"
                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazyloaded border-blue" alt="{{ $item->name }}"
                            decoding="async" data-ll-status="loaded"><noscript><img width="450" height="420"
                                src="{{ $item->url_image }}"
                                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""
                                decoding="async" /></noscript></div>
                    <div class="group-action">
                        <div class="shop-action">
                            @if (auth()->user() != null)
                            <button class="woosw-btn woosw-btn-{{ $item->id }} btn-add-favorites {{ $item->favorites_count != null && $item->favorites_count >= 1 ? 'color-bck-hover-auto': '' }}" data-id="{{ $item->id }}" data-product_name="{{ $item->name }}"
                                data-product_image="{{ $item->url_image }}">Agregar a favoritos</button>
                            @endif
                            <a href="{{ route('front.shop.show', $item->id) }}"
                                class="woosq-btn woosq-btn-267" data-id="267" data-effect="mfp-3d-unfold"
                                data-context="default">Ver</a>
                        </div>
                    </div>
                    <a href="{{ route('front.shop.show', $item->id) }}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"></a>
                </div>
                <h3 class="woocommerce-loop-product__title"><a
                    href="{{ route('front.shop.show', $item->id) }}">{{ $item->name }}</a></h3>
                <span class="price">
                    @if ($item->discount_percentage > 0)
                        <del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $item->original_price_format}}</bdi></span></del> 
                    @endif
                    <ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">£</span>{{ $item->price_format }}</bdi></span></ins>
                </span>
                <a href="{{ route('front.shop.show', $item->id) }}" data-quantity="1"
                    class="button wp-element-button product_type_variable add_to_cart_button "
                    data-product_id="{{ $item->id }}" data-product_sku="ergonomic-concrete-lamp-52303043"
                    aria-label="Select options for “{{ $item->name }}”" rel="nofollow"><span class="text-blue-tono">Ver producto</span> <span class="text-blue-tono ml-10px"><i class="fas fa-forward"></i></span></a>
            </div>
        </li>
    @endforeach
</ul>
