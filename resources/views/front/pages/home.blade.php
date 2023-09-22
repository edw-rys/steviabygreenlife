@extends('front.includes.template')

{{-- Class rename --}}
@section('class-body-template')
theme @endsection
{{-- End class rename --}}

@section('head-content')
    @include('front.includes.head')
@endsection
@section('main-content')
<div class="style-full-width-layout page-layout theme25 clearfix ">
    <a class="scrollToTop transition-all fa fa-angle-up none" title="Desplazarse hacia arriba"></a>

    @include('front.pages.home.cart-btn')
    <div class="content slide">
        <div class="content-wrapper">
            <div class="content">

                @include('front.pages.home.banner')
                @include('front.pages.home.powder')
                @include('front.pages.home.steviadrops')
                @include('front.pages.home.usein')
                @include('front.pages.home.recetas')
                @include('front.pages.home.stevialovers')
                @include('front.pages.home.redessociales')
                @include('front.pages.home.location')
            </div>
        </div>
    </div>
    @include('front.pages.home.cart-panel')
    <a class="float-button" target="_blank" href="https://api.whatsapp.com/send/?phone={{ config('app.phone_number')}}">
        <i class="fa fa-whatsapp" aria-hidden="true"></i>
    </a>
      
    
</div>
@include('front.includes.foot')

@endsection

@section('scripts_body_last')
<script type="text/javascript">
    let imagesListExpand = {
        index: 0,
        list : [
            '{{ asset('images/banner/stevia-powder-portada-1.png')}}',
            '{{ asset('images/banner/stevia-drop-banner-1.png')}}'
        ]
    };
    let imagesListMob = {
        index: 0,
        list : [
            '{{ asset('images/banner/Portada_Stevia_Powder-2522430.png')}}',
            '{{ asset('images/banner/Portada_Stevia_Drops-2521957.png')}}'
        ]
    };
    // WebPlatform.onReady(function() {
    //     $('#banner-slider-show-panel').webPlatformSlider({
    //         stopOnHover: false,
    //         showArrows: true,
    //         showBullets: false,
    //         showProgress: false,
    //         layerAreaStartWidth: Math.min(1421, 1100),
    //         slideDuration: 7000,
    //         slideTransitionTime: 200,
    //         slideAnimationType: 'none'
    //     });

    // });
    setInterval(() => {
        if(imagesListExpand.index+1 > imagesListExpand.list.length-1 ){
            imagesListExpand.index = 0
        }else{
            imagesListExpand.index++;
        }
        $('#banner-slider-show-panel').css(
            'background', 'url(' + imagesListExpand.list[imagesListExpand.index]+') center center no-repeat'
        )

        if(imagesListMob.index+1 > imagesListMob.list.length-1 ){
            imagesListMob.index = 0
        }else{
            imagesListMob.index++;
        }
        $('#slider-widget-slider-1682342703332').css(
            'background', 'url(' + imagesListMob.list[imagesListMob.index]+') center center no-repeat'
        )
    }, 4000);
    var lastWidhtGlobal = 0;
    function setDefaultsImages(){
        if(windowWidth<=768){
            if(lastWidhtGlobal > 768){
                console.log('cambio 768 <', lastWidhtGlobal);
                lastWidhtGlobal = windowWidth;
                document.getElementById('container-widget-1646942986617').className = 'grid-row mobile-only non-stretched-mobile non-stretched-mobile-style';
            }
        }else{
            if(lastWidhtGlobal <= 768){
                console.log('cambio 768 >=', lastWidhtGlobal );
                lastWidhtGlobal = windowWidth;
                document.getElementById('container-widget-1646942986617').className = 'grid-row grid-row-fullwidth phone-hidden tablet-hidden stretched-mobile stretched-tablet';
            }
        }
    }
    window.onresize = function(event) {
        setDefaultsImages();
    };
    setDefaultsImages();
</script>
@endsection