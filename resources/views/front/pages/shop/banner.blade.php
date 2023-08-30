<div class="freshio-breadcrumb">
    <div class="col-full">
        <h1 class="breadcrumb-heading" style="color: white">
            Tienda
        </h1>
        <nav class="woocommerce-breadcrumb"><a href="{{ route('front.shop')}}" style="color: white">Inicio</a><span style="color: white" class="breadcrumb-separator"> / </span>
            <span style="color: white">Tienda</span>
        {{-- @if(request('s') != null && !empty(request('s')) && request('s') != '')
            <span class="breadcrumb-separator"> / </span>Resultados de la búsqueda: {{request('s')}}
        @endif --}}
        </nav>
    </div>
</div>
