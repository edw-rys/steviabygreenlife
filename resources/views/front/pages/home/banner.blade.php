<div id="container-widget-1646942986617" data-type="Container"
    class="grid-row grid-row-fullwidth phone-hidden tablet-hidden stretched-mobile stretched-tablet" data-delay=""
    style="padding-bottom:0%;padding-top: 0%; padding-left: 0;background-color: rgba(0, 183, 179, 1);background-position: center center;background-repeat: no-repeat;background-size: cover;background-image: none;">
    <div class="">
        <div class="grid-column   grid-column-with-bg  has-bg-image  "
            style="width: 100%;padding-left:0%;padding-right:0%;background-color: transparent;background-image: url('{{ asset('images/banner/Fondo_Video-2529473.svg') }}');background-size: auto;background-repeat: no-repeat;background-position: center top;top: 0px;">
            {{-- MENU --}}
            <div class="mobile-menu-steviaweb">
                <div class="menu-navigation-item">
                    <input type="checkbox" name="" id="check-menu-open">
                    <label for="check-menu-open" class="checkbtn-item">
                        <img src="{{ asset('images/menunav.png') }}" alt="" class="img-hamburguer-nav">
                    </label>
                    <a href="#" class="enlace">
                        <img src="{{ asset('images/resources/logo-stevia.png') }}" alt="logo"
                            class="img-logo-stevia">
                    </a>
                    <div class="separator-line-menu-stevia"></div>
                    <ul class="stevia-menu-principal">
                        <li class="subitems-principal-menu"><a href="{{ route('front.shop') }}">Tienda</a></li>
                        <li class="subitems-principal-menu">
                            <div>
                                <a href="javascript:;">
                                    Productos
                                    <i class="fas fa-chevron-down angle-menu-item"></i>
                                </a>
                            </div>
                            <ul class="submenus-items-child">
                                <li class="subitem-option-child">
                                    <a class="link-submenu-item" href="#stevia-powder" onclick="$('#check-menu-open').prop('checked', false)">Stevia Powder</a>
                                </li>
                                <li class="subitem-option-child">
                                    <a class="link-submenu-item" href="#stevia-drops" onclick="$('#check-menu-open').prop('checked', false)">Stevia Drops</a>
                                </li>
                            </ul>
                        </li>
                        <li class="subitems-principal-menu"><a href="#tips-stevia" onclick="$('#check-menu-open').prop('checked', false)">Tips</a></li>
                        <li class="subitems-principal-menu"><a href="#recetas" onclick="$('#check-menu-open').prop('checked', false)">Recetas</a></li>
                    </ul>
                    <div class="with-quick-cart center-flex mr-5px">
                        <a href="{{ route('front.shop') }}" class="store-cart-button store-cart-btn-new">
                            <img src="{{ asset('images/cart.png') }}" style="width: 37px" alt="">
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="widget-row with-centered-content">
            <div class="widget widgetResponsive imageWidget  banner-logo-with"
                id="image-widget-1681919826825" data-type="ImageWidget" data-delay=""
                data-animation-duration="" data-animation-delay=""
                data-animation="lazyAnimation-" style="margin-top: 0.509091%; margin-left: 0%;">

                <div class="image-box  image-position-center">
                    <div class="widget-preserving-ratio-outer "
                        style="padding-bottom: 57.183098591549296%">

                        <div class="widget-preserving-ratio-inner"
                            data-slide="{{ asset('images/resources/Mesa_de_trabajo_1-1924215.svg') }}">
                            <a class="lazyImage flex flex-col image-cover-width image-cover"
                                style="">
                                <img src="{{ asset('images/resources/Mesa_de_trabajo_1-1924215.svg')}}"
                                    class="flex-none" alt="" style=""
                                    loading="lazy">
                            </a>
                            <h1 class="hidden">Stevia By Green Life</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
            <div class="widget-row with-centered-content" style="margin-top: 83px;position: relative;">
                <div class="" id="video-widget-1682451679794" data-type="VideoWidget" data-delay=""
                    data-animation-duration="" data-animation-delay="" data-animation="lazyAnimation-"
                    style="margin-top: 0%; margin-left: 0px;">

                    <div 
                    {{-- class="widget-preserving-ratio-outer video-position-left" --}}
                        {{-- style="padding-bottom: 56.18090452261306%" --}}
                        >
                        <div 
                            {{-- class="widget-preserving-ratio-inner" --}}
                            >
                            <div class="video-player video-thumb-bg" style="position: relative">
                                <iframe class="full-size-abs"
                                    style=""
                                    src="https://www.youtube.com/embed/HZIjazdwAwg" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen=""></iframe><!-- */ <!-- --></div>
                                <img src="{{ asset('images/banner/cut-line.png')}}" alt="" style="    position: absolute;bottom: 0;width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-row ">
                {{-- Expanded --}}
                <div class="widget anim-delayed-item widgetResponsive sliderWidget col20"
                    id="slider-widget-1681919826819" data-type="Slider" data-delay="" data-animation-duration="1100"
                    data-animation-delay="0" data-animation="lazyAnimation-fadeInLeft"
                    style=" margin-left: 0px;">
                    <div class="widget-preserving-ratio-outer" style="padding-bottom: 37.79028852920479%">
                        <div class="widget-preserving-ratio-inner" style="overflow: hidden">
                            <div class="tmdp-slider full-size" id="banner-slider-show-panel"
                                style="background: url(&quot;{{ asset('images/banner/stevia-powder-portada-1.png') }}&quot;) center center no-repeat;">
                                <div class="tmdp-slide tmdp-show" data-bg-type="image" id="banner-slide-first-time"
                                    data-bg="{{ asset('images/banner/stevia-powder-portada-1.png') }}"
                                    style="font-size: 11.7855px;">
                                    <div class="tmdp-layers" style="height: 350px; margin-top: -175px;">
                                    </div>
                                    <h2 class="hidden">Endulza sin cambiar el sabor</h2>
                                    <a href="/store" target="_self"
                                        class=" hvr-grow-shadow  border-color-primary banner-button-buy-now"
                                        style="position: absolute;bottom: 79px;left: 77px;">
                                        <span class="">¡Comprala ahora!</span>
                                    </a>
                                </div>
                                <div class="tmdp-slide" data-bg-type="image"
                                    data-bg="{{ asset('images/banner/stevia-drop-banner-1.png') }}"
                                    style="font-size: 11.7855px;">
                                    <div class="tmdp-layers" id="banner-slide-second-time"
                                        style="height: 350px; margin-top: -175px;">
                                        <div class="tmdp-layer render-crisp tmdp-layer-text"
                                            style="left: 10%; top: 20%; background: transparent; animation-duration: 0.3s; animation-delay: 0s; animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);"
                                            data-start="300" data-speed="300" data-animation-type="fadeIn">
                                            <p style="font-size: 100%;"><br style="font-size: 100%;">
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="tmdp-nav-arrow tmdp-leftarrow"><i class="fa fa-angle-left fa-2x"></i>
                                </div>
                                <div class="tmdp-nav-arrow tmdp-rightarrow"><i class="fa fa-angle-right fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="widget-row ">
                {{-- <script type="text/javascript">
                WebPlatform.onReady(function() {
                    $('#slider-widget-1682342703332').webPlatformSlider({
                        stopOnHover: false,
                        showArrows: false,
                        showBullets: false,
                        showProgress: false,
                        layerAreaStartWidth: Math.min(342, 1100),
                        slideDuration: 7000,
                        slideTransitionTime: 200,
                        slideAnimationType: 'none'
                    });
                });
            </script> --}}

                {{-- Mobile --}}
                <div class="widget  widgetResponsive sliderWidget col20" id="slider-widget-1682342703332"
                    data-type="Slider" data-delay="" data-animation-duration="" data-animation-delay=""
                    data-animation="lazyAnimation-" style="margin-top: 0%; margin-left: 0px;">
                    <div class="widget-preserving-ratio-outer" style="padding-bottom: 100%">
                        <div class="widget-preserving-ratio-inner" style="overflow: hidden">
                            <div class="tmdp-slider full-size" id="slider-widget-slider-1682342703332"
                                style="background: url(&quot;{{ asset('images/banner/Portada_Stevia_Drops-2521957.png') }}&quot;) center center no-repeat;">
                                <div class="tmdp-slide" data-bg-type="image"
                                    data-bg="{{ asset('images/banner/Portada_Stevia_Powder-2522430.png') }}"
                                    style="font-size: 4.09357px;">
                                    <div class="tmdp-layers" style="height: 100px; margin-top: -50px;">
                                    </div>
                                </div>
                                <div class="tmdp-slide tmdp-show" data-bg-type="image"
                                    data-bg="{{ asset('images/banner/Portada_Stevia_Drops-2521957.png') }}"
                                    style="font-size: 4.09357px;">
                                    <div class="tmdp-layers" style="height: 100px; margin-top: -50px;">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="text-center" style="background: #00B6B2">
                        <a href="/store" target="_self" class=" hvr-grow-shadow  border-color-primary banner-button-buy-now">
                            <span class="">¡Comprala ahora!</span>
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="widget-row with-centered-content">
            <div class="widget widgetResponsive buttonWidget col20"
                id="button-widget-1683119089043" data-type="Button" data-delay=""
                data-animation-duration="" data-animation-delay=""
                data-animation="lazyAnimation-" style="margin-top: 0.0707714%; margin-left: 0px;">
                <div class="main-widget-content">
                    <div style="text-align: center;">
                    </div>
                </div>
            </div>
        </div> --}}
        </div>
    </div>
</div>
