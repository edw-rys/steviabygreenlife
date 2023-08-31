@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
class-body-templateproduct-template-default single single-product postid-285 wp-embed-responsive theme-freshio woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-full-width-content freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit @endsection
{{-- End class rename --}}


@section('head-content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles/auth/style.css')}}">
    @include('front.includes.head-shop')
    
@endsection
@section('main-content')
    @include('front.pages.shop.header')
    <div class="freshio-breadcrumb" style="background: #00BAB4;color:white">
        <div class="col-full">
            <h1 class="breadcrumb-heading">
                Inicio de sesión </h1>
            <nav class="woocommerce-breadcrumb" style="color:white">
                <a style="color:white" href="{{ route('front.shop')}}">Inicio</a>
                <span style="color:white" class="breadcrumb-separator"> / </span> Olvidé mi contraseña
            </nav>
        </div>
    </div>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Restablecer mi contraseña</div>
                        <div class="card-body">
        
                          @if (Session::has('message'))
                               <div class="alert alert-success" role="alert">
                                  {{ Session::get('message') }}
                              </div>
                          @endif
                          @if (Session::has('error_message'))
                               <div class="alert alert-danger" role="alert">
                                  {{ Session::get('error_message') }}
                              </div>
                          @endif
        
                            <form action="{{ route('forget.password.post') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Enviar enlace para restablecer contraseña
                                    </button>
                                </div>
                            </form>
                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </main>

@endsection

