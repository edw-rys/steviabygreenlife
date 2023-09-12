@component('mail::message')
<style>
      .badge.badge-warning {
        background-color: #ff990d;
      color: #fff; }
      .badge.badge-primary {
      background-color: #00BAB4; }
    .badge.badge-secondary {
      background-color: #cdd3d8; }
    .badge.badge-success {
      background-color: #47c363; }
    .badge.badge-info {
      background-color: #3abaf4; }
    .badge.badge-danger {
      background-color: #fc544b; }
      .badges .badge {
    margin: 0 8px 10px 0; }
  
  .badge {
    vertical-align: middle;
    padding: 7px 12px;
    font-weight: 600;
    letter-spacing: .3px;
    border-radius: 30px;
    font-size: 12px; }
    .badge-success {
        color: #fff;
    background-color: #28a745;
}
.badge-danger {
    color: #fff;
    background-color: #dc3545;
}

</style>
<h1>Nueva compra realizada, pedido # {{$cart->numero_pedido}}</h1>
<span class="badge {{ badgeStatusStore($cart->status) }}" style="font-size: 13px;padding: 7px;"> @lang('global.status-label.'. ( $cart->status ?? 'in-process'))</span>
<h3 style="font-weight: bold">Datos de envío</h3>

<table style="width: 100%">
    <tbody>
        <tr>{{-- NAMES --}}
            <td><strong>Nombres</strong></td>
            <td><strong>Apelllidos</strong></td>
        </tr>
        <tr>
            <td>{{ $cart->billing->name }}</td>
            <td>{{ $cart->billing->last_name }}</td>
        </tr>
        <tr>
            <td><strong>Celular</strong></td>
            <td><strong>Dirección de correo electrónico</strong></td>
        </tr>
        <tr>
            <td>{{ $cart->billing->phone }}</td>
            <td>{{ $cart->billing->email }}</td>
        </tr>
        <tr>
            <td><strong>Cédula</strong></td>
            <td><strong>Nombre de la compañía</strong></td>
        </tr>
        <tr>
            <td>{{ $cart->billing->identification_number }}</td>
            <td>{{$cart->billing->business_name ?? 'S/N'}}</td>
        </tr>
        <tr>{{-- LOCATION --}}
            <td><strong>País</strong></td>
            <td><strong>Provincia</strong></td>
        </tr>
        <tr>
            <td>{{ $cart->billing->country->name ?? '-' }}</td>
            <td>{{ $cart->billing->state->name ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Ciudad</strong></td>
            <td><strong>Dirección</strong></td>
        </tr>
        <tr>
            <td>{{ $cart->billing->city->name ?? '--------' }}</td>
            <td>{{ $cart->billing->address }}</td>
        </tr>
        <tr>{{-- Otros datos --}}
            <td><strong>Apartamento, suite, unidad, etc.</strong></td>
            <td><strong>Código Postal</strong></td>
        </tr>
        <tr>
            <td>{{ $cart->billing->apartamento ?? '-' }}</td>
            <td>{{ $cart->billing->postal_code }}</td>
        </tr>
    </tbody>
</table>
{{-- COMPRA --}}
<h3 style="font-weight: bold">Productos</h3>
<table style="width: 100%;border-collapse: collapse" border="1">
    <thead>
        <tr>
            <th style="width: 20%">Imagen</th>
            <th style="width: 50%">Detalle</th>
            <th style="width: 15%">Cantidad</th>
            <th style="width: 15%">Precio</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cart->products as $itemCart)
            <tr>
                <td><img src="{{$itemCart->url_image}}" style="width: 100px;height: 120px;" alt=""></td>
                <td>{{ $itemCart->name}}</td>
                <td>{{ $itemCart->count}}</td>
                <td><p style="margin: 0;text-align: right">$ {{ $itemCart->total_format}}</p></td>
            </tr>
        @endforeach
        <tr>{{-- Discount --}}
            <td colspan="3">Subtotal</td>
            <td><p style="margin: 0;text-align: right">$ {{ $cart->subtotal_before_discount_code_format }}</p></td>
        </tr>
        @if ($cart->discount_code && $cart->discountCart != null)
            <tr>{{-- Discount --}}
                <td colspan="3">Descuento con cupón: <strong>{{ $cart->discountCart->code }}</strong></td>
                <td><p style="margin: 0;text-align: right;color: red">- $ {{ $cart->discount_code_format }}</p></td>
            </tr>
        @endif
        <tr>{{-- Delivery --}}
            <td colspan="3">Costo de envío</td>
            <td><p style="margin: 0;text-align: right">$ {{ $cart->delivery_cost_format }}</p></td>
        </tr>
        <tr>{{-- Total --}}
            <td colspan="3">Total + envío</td>
            <td><p style="margin: 0;text-align: right">$ {{ $cart->total_more_delivery_format }}</p></td>
        </tr>
    </tbody>
</table>

{{ config('app.company_name') }}
@endcomponent
