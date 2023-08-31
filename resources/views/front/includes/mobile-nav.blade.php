<div class="freshio-mobile-nav">
    <a href="#" class="mobile-nav-close"><i class="freshio-icon-times"></i></a>
    <nav class="mobile-navigation" aria-label="Mobile Navigation">
        <div class="handheld-navigation">
            <ul id="menu-main-menu-2" class="menu">
                
                @if (auth()->check())
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89">
                        <a href="#!">
                            <span class="menu-title">{{ auth()->user()->full_name }} </span>
                        </a>
                    </li>

                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89">
                        <a href="{{ route('user.profile')}}">
                            <span class="menu-title"> > Mi perfil</span>
                        </a>
                    </li>

                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89">
                        <a href="{{ route('user.favorites')}}">
                            <span class="menu-title"> > Mis favoritos</span>
                        </a>
                    </li>

                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89">
                        <a href="{{ route('user.shopping')}}">
                            <span class="menu-title"> > Mis compras</span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89">
                        <a href="{{ route('user.shopping')}}">
                            <span class="menu-title"> > Mis compras</span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89">
                        <a href="{{ route('user.change-password')}}">
                            <span class="menu-title"> > Cambiar contraseña</span>
                        </a>
                    </li>
                @else
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89">
                        <a href="{{ route('auth.login')}}">
                            <span class="menu-title">Iniciar sesión</span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89">
                        <a href="{{ route('auth.register')}}">
                            <span class="menu-title">Crear usuario</span>
                        </a>
                    </li>
                @endif
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89">
                    <a href="{{ route('front.index')}}">
                        <img src="{{ asset('images/resources/Mesa_de_trabajo_1-1924215.svg')}}"
                                    class="flex-none" alt="Stevia" style="width: 10em"
                                    loading="lazy">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
