@extends('front.includes.template')
{{-- Class rename --}}
@section('class-body-template')
    page-template-default page page-id-75 wp-embed-responsive theme-freshio woocommerce-cart woocommerce-page woocommerce-js
    woo-variation-swatches wvs-behavior-blur wvs-theme-demo-child wvs-show-label wvs-tooltip chrome product-hover-default
    freshio-layout-wide woocommerce-active product-style-1 freshio-product-tablet-3 freshio-product-mobile-2
    single-product-1 freshio-footer-builder elementor-default elementor-kit-334 has-scrollbar e--ua-blink e--ua-chrome
    e--ua-webkit
@endsection
{{-- End class rename --}}

@section('head-content')
    @include('front.includes.head-shop')
@endsection

{{-- Scripts --}}
@section('scripts_body_after')
<script src="https://pay.payphonetodoesposible.com/api/button/js?appId={{ config('app.custompay.id_app')}}"></script>
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
                }
            },
            error: function (error) {
                notifyErrorGlobal(error);
            },
        });
    }

    function getCities(id, myStateId) {
        $('#billing_state_id').val(null).trigger('change');
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
    /**
     * 
     */
    function changeCityDelivery(id) {
        if(!id){return;}
        block($('#order_review'));
        $.easyAjax({
            url: '{{ route('front.cart.billing.change-city') }}',
            container: '#formUpdateItems',
            type: "PUT",
            redirect: false,
            data: {
                _token: '{{ csrf_token() }}',
                tokenCart: '{{ $cart->uuid }}',
                city_id: id
            },
            success: function(response) {
                if (response.message) {
                    $.notify(
                        response.message, 
                        { position:"bottom right",className:"success" }
                    );
                }        
                $('#order_review').html(response.html_order);
                unblock($('#order_review'));
            },
            error: function(error) {
                unblock($('#order_review'));
                notifyErrorGlobal(error);
            },
        });
    }
    /**
     * Proceder a la verificación
     * @argument
     */
    function processCheckout(evt){
        evt.preventDefault();
        block($('#form-checkout'))
        $('#tokenCartVal').val(localStorage.getItem(enviropments.cartTokenStorage));
        $.easyAjax({
            url: '{{ route('front.cart.save-checkout') }}',
            container: '#form-checkout',
            type: "POST",
            redirect: false,
            data: $('#form-checkout').serialize(),
            success: function(response) {
                if (response.message) {
                    $.notify(
                        response.message, 
                        { position:"bottom right",className:"success" }
                    );
                }
                $('#order_review').html(response.html_order);
                unblock($('#form-checkout'));
                $('#place_order').addClass('hidden');
                $('#clientTransactionIdBill').val(response.payment.client_id);
                payphone.Button({
                    //token obtenido desde la consola de developer
                    token: response.payment.token,
                    //PARÁMETROS DE CONFIGURACIÓN
                    btnHorizontal: true,
                    btnCard: true,
                    createOrder: function(actions){
                    //Se ingresan los datos de la transaccion ej. monto, impuestos, etc
                    return actions.prepare({
                            amount: response.total,
                            amountWithoutTax: response.total,
                            currency: response.currency,
                            clientTransactionId: response.payment.client_id,
                            lang: "es",
                            email: response.billing.email,
                            // phoneNumber: response.billing.phone,
                            documentId: response.billing.identification_number
                        }).then(function(paramlog){
                            console.log(paramlog);
                            return paramlog;
                        }).catch(function(paramlog2){
                            // location.reload();
                            console.log(paramlog2);
                            return paramlog2;
                        });
                    },

                    onComplete: function(model, actions){
                    }
                }).render("#pp-button");
                        
            },
            error: function(error) {
                unblock($('#form-checkout'));
                notifyErrorGlobal(error);
            },
        });
    }
    /**
     * Proceder a enviar comprobantes de pago
     * @argument
     */
    function processToSolicitud() {
        block($('#form-checkout'))
        $('#tokenCartVal').val(localStorage.getItem(enviropments.cartTokenStorage));
        $.easyAjax({
            url: '{{ route('front.cart.save-solicitud-transfer') }}',
            container: '#form-checkout',
            type: "POST",
            redirect: true,
            file:true,
            data: $('#form-checkout').serialize(),
            error: function(error) {
                unblock($('#form-checkout'));
                notifyErrorGlobal(error);
            },
        });
    }

    function addNewFile() {
        var newId = generateRandomString(10);
        var newEl = addTemplateFileCompany(newId);
        $('#contentsFileUpload').append(newEl);
        $('#file-bank-comprobante-'+newId).trigger('click');
    }

    function changeFileComprobante(event, idEl) {
        if (event.target.files && event.target.files[0]) {
            if (event.target.files[0].size > enviropments.max_size_img *1000000 ) {
                $.notify(
                    'Peso máximo '+enviropments.max_size_img + 'MB', 
                    { position:"bottom right",className:"warn" }
                );
                return;
            }
        }
        $('#span-file-add-'+idEl).html(event.target.files[0].name);
        if($('.images-files-transfers-el').length >= 3){
            $('#add-file-transfer-btn').addClass('hidden');
        }else{
            $('#add-file-transfer-btn').removeClass('hidden');
        }
    }

    function processSelectMethodPayment() {
        $('#process-to-checkout-methods').addClass('hidden')
        if ($('#payment_method_payphone').prop('checked')) {
            $('#mode-pay-tc').removeClass('hidden');
        }else{
            $('#mode-pay-tc').addClass('hidden');
        }
        if($('#payment_method_bacs').prop('checked')){
            $('#mode-pay-transferencia').removeClass('hidden');
        }else{
            $('#mode-pay-transferencia').addClass('hidden');
        }
    }

    function resetSelectMethodPayment() {
        $('#process-to-checkout-methods').removeClass('hidden');
        $('#mode-pay-tc').addClass('hidden');
        $('#mode-pay-transferencia').addClass('hidden');
    }
    /**
     * Eliminar archivo
     * @argument
     */
    function deleteFileUpload(id) {
        $('#item-new-file-'+id).remove();
        if($('.images-files-transfers-el').length >= 3){
            $('#add-file-transfer-btn').addClass('hidden');
        }else{
            $('#add-file-transfer-btn').removeClass('hidden');
        }
    }    

    function addTemplateFileCompany(newId) {
        return `<a
            id="item-new-file-${newId}"
            href="javascript:;" data-toggle="modal" 
            class="d-grid-temp-files item-image-photo images-files-transfers-el">
            <div class="pos__ticket__item-name truncate mr-1" style="overflow: hidden;">
                <span id="span-file-add-${newId}">Agregando archivo...</span>
            </div>
            <div class="ml-auto font-medium" onclick="deleteFileUpload('${newId}')"><i class="fa fas fa-trash"></i></div>
            <input type="file" name="transferencias[]" id="file-bank-comprobante-${newId}" class="d-none hidden" accept=".png, .jpg, .jpeg, .pdf" onchange="changeFileComprobante(event, '${newId}')">
        </a>`;
    }
    
    getStates('{{ $cart->billing->state_id }}');

</script>
@endsection

@section('main-content')
    @include('front.pages.shop.header')
    <div class="freshio-breadcrumb"  style="background: #00BBB5;">
        <div class="col-full bck-banner-shop">
            <h1 class="breadcrumb-heading" style="color: #F9DD6C">Verificar compra</h1>

            <nav class="woocommerce-breadcrumb color-white"><a class="color-white"
                    href="{{ route('front.shop') }}">Inicio</a><span class="breadcrumb-separator color-white"> /
                </span>Verificar compra</nav>
        </div>
    </div>
    {{-- form --}}
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div id="primary">
                <main id="main" class="site-main" role="main">
                    <article id="post-77" class="post-77 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper"></div>
                                <form name="checkout" method="post" class="checkout woocommerce-checkout"
                                    id="form-checkout"
                                    action="{{ route('front.cart.save-checkout')}}" enctype="multipart/form-data"
                                    novalidate="novalidate"
                                    onsubmit="processCheckout(event)">
                                    <div class="col2-set" id="customer_details">
                                        <div class="col-1">
                                            @csrf
                                            <input type="hidden" name="clientTransactionId" id="clientTransactionIdBill">
                                            {{-- tokenCart --}}
                                            <input type="hidden" id="tokenCartVal" value="" name="tokenCart">
                                            <div class="woocommerce-billing-fields">
                                                <h3>Datos de facturación</h3>
                                                <div class="woocommerce-billing-fields__field-wrapper">
                                                    <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10">
                                                        <label for="billing_first_name" class="">Nombres&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text"
                                                                class="input-text" name="billing_first_name"
                                                                id="billing_first_name" placeholder="" value="{{ $cart->billing->name }}"
                                                                autocomplete="given-name">
                                                            {!!$errors->first("billing_first_name", "<span class='text-danger'>:message</span>")!!}
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">
                                                        <label for="billing_last_name" class="">Apelllidos&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text"
                                                                class="input-text " name="billing_last_name"
                                                                id="billing_last_name" placeholder="" value="{{ $cart->billing->last_name }}"
                                                                autocomplete="family-name">
                                                            {!!$errors->first("billing_last_name", "<span class='text-danger'>:message</span>")!!}
                                                        </span>
                                                    </p>
                                                    
                                                    
                                                    {{-- Company name --}}
                                                    <p class="form-row form-row-wide" id="billing_identification_number_field" data-priority="30">
                                                        <label for="billing_identification_number" class="">Cédula&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text" class="input-text " name="billing_identification_number" id="billing_identification_number" placeholder="" value="{{ $cart->billing->identification_number }}">
                                                            {!!$errors->first("billing_identification_number", "<span class='text-danger'>:message</span>")!!}
                                                        </span>
                                                    </p>
                                                    {{-- Company name --}}
                                                    <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                        <label for="billing_company" class="">Nombre de la compañía&nbsp;<span class="optional">(opcional)</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text" class="input-text " name="billing_company" id="billing_company" placeholder="" value="{{ $cart->billing->business_name }}" autocomplete="organization">
                                                            {!!$errors->first("billing_company", "<span class='text-danger'>:message</span>")!!}
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-wide address-field update_totals_on_change validate-required"
                                                        id="billing_country_field" data-priority="40"><label
                                                            for="billing_country" class="">País: <strong> {{ $country->name }}</strong></label>
                                                        <input type="hidden" value="{{ $country->id}}" name="billing_country_id">
                                                    </p>
                                                    {{-- states --}}
                                                    <p class="form-row form-row-wide address-field update_totals_on_change validate-required"
                                                        id="billing_country_field" data-priority="40"><label
                                                            for="form-states" class="">Provincia&nbsp;<abbr class="required"
                                                                title="required">*</abbr></label><span
                                                            class="woocommerce-input-wrapper">
                                                        <select id="form-states" name="billing_state_id" class="select2" onchange="getCities(this.value, {{$cart->billing->city_id ?? 'null'}})"></select>
                                                        {!!$errors->first("billing_state_id", "<span class='text-danger'>:message</span>")!!}
                                                    </p>

                                                    {{-- cities --}}
                                                    <p class="form-row form-row-wide address-field update_totals_on_change validate-required"
                                                        id="billing_country_field" data-priority="40"><label
                                                            for="form-cities" class="">Ciudad&nbsp;<abbr class="required"
                                                                title="required">*</abbr></label><span
                                                            class="woocommerce-input-wrapper">
                                                        <select id="form-cities" name="billing_city_id" class="select2" onchange="changeCityDelivery(this.value)"></select>
                                                        {!!$errors->first("billing_city_id", "<span class='text-danger'>:message</span>")!!}
                                                    </p>
                                                    {{-- Address --}}
                                                    <p class="form-row address-field validate-required form-row-wide"
                                                        id="billing_address_field" data-priority="50"><label
                                                            for="billing_address" class="">Dirección&nbsp;<abbr class="required"
                                                                title="required">*</abbr></label><span
                                                            class="woocommerce-input-wrapper">
                                                        <input type="text"
                                                            class="input-text " name="billing_address"
                                                            id="billing_address"
                                                            placeholder="Número de casa y nombre de la calle." value="{{ $cart->billing->address }}"
                                                            autocomplete="address-line1"
                                                            data-placeholder="Número de casa y nombre de la calle.">
                                                        </span>
                                                    </p>
                                                    {{-- Apartamento --}}
                                                    <p class="form-row address-field form-row-wide" id="billing_apartamento_field" data-priority="60">
                                                        <label for="billing_apartamento" class="screen-reader-text">Apartamento, suite, unidad, etc.&nbsp;<span class="optional">(optional)</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text"
                                                                class="input-text " name="billing_apartamento"
                                                                id="billing_apartamento"
                                                                placeholder="Apartamento, suite, unidad, etc. (optional)"
                                                                value="{{ $cart->billing->apartamento }}" autocomplete="address-line2"
                                                                data-placeholder="Apartamento, suite, unidad, etc. (optional)">
                                                            </span>
                                                    </p>
                                                    {{-- Postal code --}}
                                                    <p class="form-row address-field validate-required validate-postal_code form-row-wide" id="billing_postal_code_field" data-priority="90" data-o_class="form-row form-row-wide address-field validate-required validate-postal_code">
                                                        <label for="billing_postal_code" class="">Código Postal &nbsp;<abbr class="required" title="required">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text"
                                                                class="input-text" name="billing_postal_code"
                                                                id="billing_postal_code" placeholder="" value="{{ $cart->billing->postal_code }}"
                                                                autocomplete="postal-code">
                                                        </span>
                                                    </p>
                                                    {{-- Phone --}}
                                                    <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100">
                                                        <label for="billing_phone" class="">Celular&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper">
                                                            <input type="tel"
                                                                class="input-text " name="billing_phone"
                                                                id="billing_phone" placeholder="" value="{{ $cart->billing->phone }}"
                                                                autocomplete="tel"></span></p>
                                                    {{-- Email --}}
                                                    <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field" data-priority="110">
                                                        <label for="billing_email" class="">Dirección de correo electrónico&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="email"
                                                                class="input-text " name="billing_email"
                                                                id="billing_email" placeholder="" value="{{ $cart->billing->email }}"
                                                                autocomplete="email username">
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="woocommerce-shipping-fields">
                                            </div>
                                            <div class="woocommerce-additional-fields">
                                                <h3>Información adicional</h3>
                                                <div class="woocommerce-additional-fields__field-wrapper">
                                                    <p class="form-row notes" id="order_comments_field" data-priority="">
                                                        <label for="order_comments" class="">Pedidos&nbsp;<span
                                                                class="optional">(optional)</span></label><span
                                                            class="woocommerce-input-wrapper">
                                                            <textarea name="order_comments" class="input-text " id="order_comments"
                                                                placeholder="Notas sobre su pedido, p.e. Notas especiales para la entrega." rows="2" cols="5">{{ $cart->billing->aditional_info }}</textarea>
                                                        </span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="order_review" class="woocommerce-checkout-review-order">
                                        @include('front.pages.checkout.order-review')
                                    </div>
                                </form>
                            </div>
                        </div>
                    </article>
                </main>
            </div>
        </div>
    </div>
@endsection
