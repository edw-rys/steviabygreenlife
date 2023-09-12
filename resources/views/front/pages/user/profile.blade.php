@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
theme archive post-type-archive post-type-archive-product wp-embed-responsive theme-freshio woocommerce-shop woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-archive-product freshio-sidebar-left freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit @endsection
{{-- class-body-templateproduct-template-default single single-product postid-285 wp-embed-responsive theme-freshio woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-full-width-content freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit @endsection --}}
{{-- End class rename --}}


@section('head-content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles/auth/style.css')}}">
    @include('front.includes.head-shop')

@endsection
@section('main-content')
    @include('front.pages.shop.header')
    {{-- <div class="freshio-breadcrumb" style="background: #00BAB4;color:white">
        <div class="col-full">
            <h1 class="breadcrumb-heading">
                Perfil </h1>
            <nav class="woocommerce-breadcrumb" style="color:white">
                <a style="color:white" href="{{ route('front.shop')}}">Inicio</a>
                <span style="color:white" class="breadcrumb-separator"> / </span> Perfil
            </nav>
        </div>
    </div> --}}

    {{-- form --}}
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div class="woocommerce"></div>
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <header class="woocommerce-products-header">
                    </header>
                    <div class="woocommerce-notices-wrapper"></div>
                    

                    {{-- form --}}
                    @if (session('title_success'))
                        <div class="woocommerce-message" role="alert"> {{session('title_success')}} </div>
                        {{ session()->forget('title_success') }}  
                    @endif
                    <section class="section">
                        <div class="container mt-5">
                          <div class="row">
                            <div class="col-12">
                                {{-- <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-5 offset-xl-3"> --}}
                              <div class="card card-primary">
                                <div class="card-header"><h4>Mis datos</h4></div>
                    
                                <div class="card-body">
                                    <form method="POST" action="{{ route('user.profile.save') }}" class="needs-validation row" novalidate="">
                                        @csrf 
                                        <div class="form-group col-12">
                                            <label for="email">Email</label><br>
                                            <strong>{{ $user->email }}</strong>
                                        </div>
                                        {{-- Nombres --}}
                                        <div class="form-group col-md-6 col-12">
                                        <div class="d-block">
                                            <label class="control-label">Nombres <span class="required">*</span></label>
                                        </div>
                                        <input type="text" class="form-control" name="name" tabindex="2" required value="{{ old('name') ?? $user->name }}">
                                        {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                                        </div>
                                        {{-- Apellidos --}}
                                        <div class="form-group col-md-6 col-12">
                                            <div class="d-block">
                                            <label class="control-label">Apellidos <span class="required">*</span></label>
                                            </div>
                                            <input type="text" class="form-control" name="last_name" tabindex="2" required value="{{ old('last_name') ?? $user->last_name }}">
                                            {!!$errors->first("last_name", "<span class='text-danger'>:message</span>")!!}
                                        </div>

                                        {{-- Cédula --}}
                                        <div class="form-group col-12">
                                            <div class="d-block">
                                            <label class="control-label">Cédula</label>
                                            </div>
                                            <input type="text" class="form-control" name="identification_number" tabindex="2" required value="{{ old('identification_number') ?? $user->identification_number }}">
                                            {!!$errors->first("identification_number", "<span class='text-danger'>:message</span>")!!}
                                        </div>

                                        {{-- País --}}
                                        <div class="form-group col-12">
                                            <div class="d-block">
                                            <label class="control-label">País</label>
                                            </div>
                                            <span>{{ $country->name }}</span>
                                        </div>

                                        {{-- Provincia --}}
                                        <div class="form-group col-md-6 col-12">
                                            <div class="d-block">
                                            <label for="form-states" class="control-label">Provincia</label>
                                            </div>
                                            <select id="form-states" name="state_id" class="select2" onchange="getCities(this.value)"></select>
                                            {!!$errors->first("state_id", "<span class='text-danger'>:message</span>")!!}
                                        </div>

                                        {{-- Ciudad --}}
                                        <div class="form-group col-md-6 col-12">
                                            <div class="d-block">
                                            <label for="form-cities" class="control-label">Ciudad</label>
                                            </div>
                                            <select id="form-cities" name="city_id" class="select2"></select>
                                            {!!$errors->first("city_id", "<span class='text-danger'>:message</span>")!!}
                                        </div>


                                        <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm btn-block" tabindex="4">
                                            Guardar datos
                                        </button>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </section>
                </main>
            </div>
            @include('front.pages.user.options-menu')
        </div>
    </div>
@endsection

@section('scripts_body_after')
    <script>
        $('.select2').select2();
        
        function getStates(myStateId) {
            $.easyAjax({
                url: '{{route('utils.get-states', $country->id)}}',
                // container: '#formSave',
                type: "GET",
                redirect: false,
                success: function (response) {
                    if(response.data){
                        var hasSelected = false;
                        var options = '<option value="">Seleccione</option>';
                        for (const item of response.data) {
                            var aditionalAttr = '';
                            if(myStateId && myStateId == item.id){
                                hasSelected = true;
                                aditionalAttr += 'selected';
                            }
                            options += `<option ${aditionalAttr} value="${item.id}">${item.name}</option>`;
                        }
                        $('#form-states').html($(options)).trigger('change');
                        if(hasSelected){
                            // getCities(myStateId, '{{ $user->city_id}}');
                        }
                    }
                },
                error: function (error) {
                    notifyErrorGlobal(error);
                },
            });
        }

        function getCities(id, myStateId) {
            if(!id){return;}
            var url = '{{route('utils.get-cities', ':id')}}';
            url = url.replace(':id', id);
            $.easyAjax({
                url,
                // container: '#formSave',
                type: "GET",
                redirect: false,
                success: function (response) {
                    if(response.data){
                        var options = '<option value="">Seleccione</option>';
                        for (const item of response.data) {
                            var aditionalAttr = '';
                            if(myStateId && myStateId == item.id){
                                aditionalAttr += 'selected';
                            }
                            options += `<option ${aditionalAttr} value="${item.id}">${item.name}</option>`;
                        }
                        $('#form-cities').html($(options)).trigger('change');
                    }
                },
                error: function (error) {
                    notifyErrorGlobal(error);
                },
            });
        }

        getStates('{{ $user->state_id }}');
    </script>
@endsection

