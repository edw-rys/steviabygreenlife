@extends('front.includes.template')
@section('main-content')
<div class="style-full-width-layout page-layout theme25 clearfix ">
    <a class="scrollToTop transition-all fa fa-angle-up none" title="Desplazarse hacia arriba"></a>

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

</div>
@include('front.includes.foot')

@endsection