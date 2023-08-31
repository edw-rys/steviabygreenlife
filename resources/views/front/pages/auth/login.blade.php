@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
class-body-templateproduct-template-default single single-product postid-285 wp-embed-responsive theme-freshio woocommerce woocommerce-page woocommerce-js woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default has-post-thumbnail freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2 single-product-1 freshio-full-width-content freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome e--ua-webkit @endsection
{{-- End class rename --}}


@section('head-content')
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                <span style="color:white" class="breadcrumb-separator"> / </span> Inicio de sesión
            </nav>
        </div>
    </div>

    @if (session('title_success'))
      <div class="woocommerce-message" role="alert"> {{session('title_success')}} </div>
      {{ session()->forget('title_success') }}  
    @endif
    <div id="app">
        <section class="section">
          <div class="container mt-5">
            <div class="row">
              <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary">
                  <div class="card-header"><h4>Login</h4></div>
      
                  <div class="card-body">
                    <form method="POST" action="{{ route('auth.login') }}" class="needs-validation" novalidate="">
                      @csrf 
                      
                      <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                        {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                      </div>
      
                      <div class="form-group">
                        <div class="d-block">
                          <label for="password" class="control-label">Password</label>
                          <div class="float-right">
                            <!--<a href="auth-forgot-password.html" class="text-small">
                              Forgot Password?
                            </a>-->
                          </div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                        {!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
                      </div>
                      {!!$errors->first("authentication", "<span class='text-danger'>:message</span>")!!}
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                          Login
                        </button>
                      </div>
                      <span class="">
                        <strong>Necesito 
                          <a class="register-link" href="{{ route('auth.register')}}"
                              title="Register">crear una cuenta</a>
                        </strong>
                      </span>
                      <hr>
                      <span class="">
                          <a class="register-link" href="{{ route('forget.password.get')}}"
                              title="Register">Olvidé mi contraseña</a>
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

