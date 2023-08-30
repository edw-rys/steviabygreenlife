<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="woocommerce"></div>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <header class="woocommerce-products-header">
                </header>
                <div class="woocommerce-notices-wrapper"></div>
                <div class="freshio-sorting"> <button class="filter-toggle" aria-expanded="false">
                        <i class="freshio-icon-filter"></i><span>Filtros</span></button>
                    <button class="filter-toggle-dropdown" aria-expanded="false">
                        <i class="freshio-icon-filter"></i><span>Filter</span></button>
                    <p class="woocommerce-result-count"> Mostrando {{ $products->showStart }}-{{ $products->showEnd }}
                        de un total de {{ $products->count }} productos</p>
                    <div class="gridlist-toggle desktop-hide-down">
                        <a href="{{ route('front.shop')}}?layout=grid" id="grid" @if (request('layout') == 'grid') class="active" @endif title="Grid View"><i
                                class="freshio-icon-th-large"></i></a>
                        <a href="{{ route('front.shop')}}?layout=list" id="list" @if (request('layout') != 'grid') class="active" @endif title="List View"><i
                                class="freshio-icon-th-list"></i></a>
                    </div>
                    <form class="woocommerce-ordering" method="GET" action="{{ currentRoute() }}">
                        <select name="orderby" class="orderby" aria-label="Shop order" onchange="this.form.submit()">
                            <option >Por defecto</option>
                            <option @if( request('orderby') != null && !empty(request('orderby')) && request('orderby')== 'price-asc') selected @endif value="price-asc">Por precio de menor a mayor</option>
                            <option @if( request('orderby') != null && !empty(request('orderby')) && request('orderby')== 'name-asc') selected @endif value="name-asc">Por orden alfabético (a-z)</option>
                            <option @if( request('orderby') != null && !empty(request('orderby')) && request('orderby')== 'name-desc') selected @endif value="name-desc">Por orden alfabético (z-a)</option>
                        </select>
                    </form>
                </div>
                    @if (request('layout') == 'grid')
                        @include('front.pages.shop.grid-products')
                    @else
                        @include('front.pages.shop.list-products')
                    @endif
                {{-- <nav class="woocommerce-pagination">
                    <ul class="page-numbers">
                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers"
                                href="https://demo2.pavothemes.com/freshio/shop/page/2/?layout=list">2</a></li>
                        <li><a class="page-numbers"
                                href="https://demo2.pavothemes.com/freshio/shop/page/3/?layout=list">3</a></li>
                        <li><a class="page-numbers"
                                href="https://demo2.pavothemes.com/freshio/shop/page/4/?layout=list">4</a></li>
                        <li><a class="next page-numbers"
                                href="https://demo2.pavothemes.com/freshio/shop/page/2/?layout=list"><span>NEXT</span><i
                                    class="freshio-icon freshio-icon-angle-double-right"></i></a></li>
                    </ul>
                </nav> --}}
            </main>
        </div>
        {{-- Categories --}}
        <div id="secondary" class="widget-area" role="complementary">
            <div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories"><span
                    class="gamma widget-title">Categorías</span>

                <ul class="product-categories">
                    <li class="cat-item cat-item-186"><a
                        href="{{ route('front.shop') }}">Todos</a> </li>
                    @foreach ($categories as $category)
                        <li class="cat-item cat-item-186"><a
                                href="{{ route('front.shop.category', $category->system_name) }}@if(request('layout')!= null)?layout={{request('layout')}}@endif">{{ $category->name }}</a>
                            <span class="count">({{ $category->products_count }})</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>



<div id="freshio-canvas-filter" class="freshio-canvas-filter">
    <span class="filter-close">Octultar</span>
    <div class="freshio-canvas-filter-wrap">
        <div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories"><span
                class="gamma widget-title">Categorías</span>
            <ul class="product-categories">
                <li class="cat-item cat-item-186"><a
                    href="{{ route('front.shop') }}">Todos</a> </li>
                @foreach ($categories as $category)
                    <li class="cat-item cat-item-186"><a
                            href="{{ route('front.shop.category', $category->system_name) }}@if(request('layout')!= null)?layout={{request('layout')}}@endif">{{ $category->name }}</a> <span
                            class="count">({{ $category->products_count }})</span></li>
                @endforeach

              
            </ul>
        </div>
    </div>
</div>
