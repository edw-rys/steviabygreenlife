<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-b324434"
    data-id="b324434" id="row-el-item-buy-{{ $cart->id}}" data-element_type="column">
    <div class="elementor-column-wrap elementor-element-populated">
        <div class="elementor-widget-wrap">
            
            <div class="elementor-element elementor-element-7ade6a3 elementor-widget-mobile__width-inherit elementor-widget elementor-widget-heading"
                data-id="7ade6a3" data-element_type="widget"
                data-widget_type="heading.default">
                <div class="elementor-widget-container">
                    <h3 class="elementor-heading-title elementor-size-default"> <a href="{{ route('front.result.pay', base64_encode($cart->transaction_code))}}">Pedido #{{ $cart->numero_pedido}} realizado el: {{$cart->bought_at_format }}</a> <span class="badge {{ badgeStatusStore($cart->status) }}" style="font-size: 13px;padding: 7px;"> @lang('global.status-label.'. ( $cart->status ?? 'in-process'))</span></h3>
                </div>
            </div>
            <div class="elementor-element elementor-element-adc11cd elementor-widget__width-initial elementor-widget-tablet__width-inherit elementor-widget elementor-widget-text-editor"
                data-id="adc11cd" data-element_type="widget"
                data-widget_type="text-editor.default">
                <div class="elementor-widget-container">
                    <div class="elementor-text-editor elementor-clearfix">Pedido pertenece a: <strong>{{ $cart->billing->last_name ?? '-'}}-{{ $cart->billing->name ?? '-'}}</strong>, email: <strong>{{ $cart->billing->email ?? '-'}} </strong>, celular: <strong>{{ $cart->billing->phone ?? '-'}}</strong> </div>
                    <div class="elementor-text-editor elementor-clearfix">Enviar a: <strong>{{ $cart->billing->country->name ?? '-'}}-{{ $cart->billing->state->name ?? '-'}}-{{ $cart->billing->city->name ?? '-'}} </strong> <span>| Estado de envío <strong style="border-bottom: 3px solid {{ $cart->status_delivery_color }};">{{ $cart->status_delivery_lang }}</strong></span></div>
                </div>
            </div>
            <div class="elementor-element elementor-element-d91d3b4 elementor-widget elementor-widget-freshio-single-product"
                data-id="d91d3b4" data-element_type="widget"
                data-widget_type="freshio-single-product.default">
                <div class="elementor-widget-container">
                    <div class="freshio-elementor-single-product">
                        <div class="woosb-wrap woosb-bundled"
                            data-id="275">
                            <div class="woosb-products">
                                @foreach ($cart->products as $item)
                                    <div class="woosb-product"
                                        data-name="Heavy Duty Paper Computer"
                                        data-price-suffix=""
                                        data-order="1">
                                        <div class="woosb-thumb">
                                            <a
                                                href="{{ route('front.shop.show', $item->product_id) }}">
                                                <div class="woosb-thumb-ori">
                                                    <img width="450"
                                                        height="420"
                                                        src="{{ $item->url_image }}"
                                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazyloaded"
                                                        alt=""
                                                        decoding="async"
                                                        data-ll-status="loaded"><noscript><img
                                                            width="450"
                                                            height="420"
                                                            src="{{ $item->url_image }}"
                                                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                            alt=""
                                                            decoding="async" /></noscript>
                                                </div>
                                                <div class="woosb-thumb-new">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="woosb-title">
                                            <div class="woosb-title-inner">
                                                <a href="{{ route('front.shop.show', $item->product_id) }}">{{ $item->name}}</a>
                                                <span> <strong> ({{ $item->count}} {{ $item->count == 1 ? 'item' : 'items'}})</strong></span>
                                            </div>
                                        </div>
                                        <div class="woosb-price">
                                            <div class="woosb-price-ori">
                                                <span class="woocommerce-Price-amount amount"><bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span> {{ $item->total_format}}</bdi></span>
                                            </div>
                                            <div class="woosb-price-new"></div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="m-0 woosb-product"> 
                                    <div class="woosb-title">
                                        <div class="woosb-title-inner">
                                            Costo de envío
                                        </div>
                                    </div>
                                    <div class="woosb-price">
                                        <div class="woosb-price-ori">
                                            <span class="woocommerce-Price-amount amount"><bdi>
                                                <span class="woocommerce-Price-currencySymbol">$</span> {{ $cart->delivery_cost_format }}</bdi></span>
                                        </div>
                                        <div class="woosb-price-new"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="woosb-total woosb-text">Costo total + envío: <span
                                    class="woocommerce-Price-amount amount"><span
                                        class="woocommerce-Price-currencySymbol">$</span>{{ $cart->total_more_delivery_format }}</span>
                                        <div>
                                            Cambiar estado de envío 
                                            <select 
                                                style="width: auto"
                                                class="select2" onchange="changeStatusDelivery('{{ $cart->id}}', this.value, 'row-el-item-buy-{{ $cart->id}}')">
                                                @foreach ($statusesDelivery as $statusItem)
                                                    <option value="{{ $statusItem->id }}" {{ $cart->status_delivery == $statusItem->code ? 'selected':''}}>{{ $statusItem->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>