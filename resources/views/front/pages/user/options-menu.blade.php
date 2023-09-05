<div id="secondary" class="widget-area" role="complementary">
    <div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories" style="padding-left: 50px">
        <span class="gamma widget-title">Opciones</span>

        <ul class="product-categories">
            <li class="cat-item cat-item-186"><a href="{{ route('user.profile') }}">Mi perfil</a></li>
            @if (auth()->user()->hasRole(getAdminName()))
                <li class="cat-item cat-item-186"><a href="{{ route('admin.shopping') }}">Ver compras realizadas</a></li>
            @else
                <li class="cat-item cat-item-186"><a href="{{ route('user.favorites') }}">Mi favoritos</a></li>
                <li class="cat-item cat-item-186"><a href="{{ route('user.shopping') }}">Mi compras</a></li>
            @endif
            <li class="cat-item cat-item-186"><a href="{{ route('user.change-password') }}">Cambiar contraseña</a></li>
        </ul>
    </div>
</div>