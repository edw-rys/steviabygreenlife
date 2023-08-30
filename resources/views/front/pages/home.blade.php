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

    
</div>
@include('front.includes.foot')

@endsection