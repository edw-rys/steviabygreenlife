<ul class="products-list">
    @forelse ($products->items as $item)
        <li
            class="product-list product type-product post-271 status-publish first instock product_cat-allium product_tag-bread has-post-thumbnail shipping-taxable purchasable product-type-variable">
            <div class="product-image">
                <img width="450" height="420" src="{{ $item->url_image }}"
                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async">
                <div class="group-action">
                    <div class="shop-action">
                        @if (auth()->user() != null)
                            <button
                                class="woosw-btn btn-add-favorites woosw-btn-{{ $item->id }} {{ $item->favorites_count != null && $item->favorites_count >= 1 ? 'color-bck-hover-auto' : '' }}"
                                data-id="{{ $item->id }}" data-product_name="{{ $item->name }}"
                                data-product_image="{{ $item->url_image }}">Agregar a favorito</button>
                        @endif
                        <a href="{{ route('front.shop.show', $item->id) }}" class="woosq-btn woosq-btn-271"
                            data-id="271" data-effect="mfp-3d-unfold" data-context="default">Ver</a>
                    </div>
                </div>

            </div>
            <div class="product-caption">
                <h3 class="woocommerce-loop-product__title"><a
                        href="{{ route('front.shop.show', $item->id) }}">{{ $item->name }}</a>
                </h3>

                <span class="price">
                    @if ($item->discount_percentage > 0)
                        <del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $item->original_price_format}}</bdi></span></del> 
                    @endif
                    <ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $item->price_format }}</bdi></span></ins>
                </span>

                {{-- <span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $item->price_format }}</bdi></span> --}}
                </span>
                <div class="short-description">
                    {!! $item->description !!}
                </div>
                <a href="{{ route('front.shop.show', $item->id) }}" data-quantity="1"
                    class="button wp-element-button product_type_variable add_to_cart_button"
                    data-product_id="{{ $item->id }}" data-product_sku="ergonomic-concrete-lamp-52303043"
                    aria-label="Select options for “{{ $item->name }}”" rel="nofollow">Ver producto</a>
            </div>
        </li>

    @empty

        <li
            class="product-list product type-product post-271 status-publish first instock product_cat-allium product_tag-bread has-post-thumbnail shipping-taxable purchasable product-type-variable">
            <div class="product-image">
                No hay productos agregados
            </div>
        </li>
    @endforelse
</ul>
