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
                Registro de usuario </h1>
            <nav class="woocommerce-breadcrumb" style="color:white">
                <a style="color:white" href="{{ route('front.shop')}}">Inicio</a>
                <span style="color:white" class="breadcrumb-separator"> / </span> Registro de usuario
            </nav>
        </div>
    </div>


    
    <div id="app">
        <section class="section">
          <div class="container mt-5">
            <div class="row">
              <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-5 offset-xl-3">
                <div class="card card-primary">
                  <div class="card-header"><h4>Registro</h4></div>
      
                  <div class="card-body">
                    <form method="POST" action="{{ route('auth.signup.post') }}" class="needs-validation" novalidate="">
                      @csrf 
                      
                      <div class="form-group">
                        <label for="email">Nombres <span class="required">*</span></label>
                        <input id="email" type="text" class="form-control" name="name" tabindex="1" required autofocus value="{{old('name')}}">
                        {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                      </div>
                      <div class="form-group">
                        <label for="email">Apellidos <span class="required">*</span></label>
                        <input id="email" type="text" class="form-control" name="last_name" tabindex="2" required value="{{old('last_name')}}">
                        {!!$errors->first("last_name", "<span class='text-danger'>:message</span>")!!}
                      </div>
                      <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input id="email" type="email" class="form-control" name="email" tabindex="3" required value="{{old('email')}}">
                        {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                      </div>
      
                      <div class="form-group">
                        <div class="d-block">
                          <label for="password" class="control-label">Contraseña <span class="required">*</span></label>
                          <div class="float-right">
                            <!--<a href="auth-forgot-password.html" class="text-small">
                              Forgot Password?
                            </a>-->
                          </div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="4" required>
                        {!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
                      </div>

                      <div class="form-group">
                        Sus datos personales se utilizarán para respaldar su experiencia en este sitio web, para administrar el acceso a su cuenta y para otros fines descritos en nuestras <a target="_blank" href="{{ route('front.terms')}}">política de privacidad</a>
                      </div>
                      
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                          Crear mi cuenta
                        </button>
                      </div>
                      <span class="">
                        <strong>
                          <a class="register-link" href="{{ route('auth.login')}}"
                              title="Register">Ya tengo una cuenta, deseo iniciar sesión</a>
                        </strong>
                      </span>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </section>
      </div>


@endsection

