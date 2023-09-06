<?php 
namespace App\Service;

use App\Models\CartShop;
use App\Models\CartShopInvoice;
use App\Models\CartShopProducts;
use App\Models\CartShopProductsStore;
use App\Models\CartShopStore;
use App\Models\Location\City;
use App\Models\Location\State;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartProductService 
{
    private Product $productModel;
    private CartShop $cartShop;
    private CartShopInvoice  $cartShopInvoice;
    private CartShopProducts $cartShopProducts;
    private CartShopProductsStore $productStore;
    private CartShopStore $cartShopStore;
    private City $cityModel;
    private State $stateModel;

    
    public function __construct(
        CartShopProductsStore $productStore,
        CartShopProducts $cartShopProducts,
        CartShopInvoice  $cartShopInvoice,
        CartShopStore    $cartShopStore,
        CartShop         $cartShop,
        Product          $productModel,
        State            $stateModel,
        City             $cityModel
    ) {
        $this->cartShop = $cartShop;
        $this->cartShopStore = $cartShopStore;
        $this->productModel = $productModel;
        $this->productStore = $productStore;
        $this->cartShopInvoice = $cartShopInvoice;
        $this->cartShopProducts = $cartShopProducts;
        $this->cityModel = $cityModel;
        $this->stateModel = $stateModel;
    }

    /**
     * @param $tokenCart
     * @param $user_id
     */
    public function getProductsByTokenCart($tokenCart, $user_id) {
        $cart = $this->getCartShop($tokenCart, $user_id, false);
        if($cart == null){
            return [
                'message'   => 'Su carrito está vacío.',
                'status'    => 'error'
            ];
        }
        $productsCart =  $this->cartShopProducts
            ->where('cart_shop_id', $cart->id)
            ->with('product')
            ->has('product')
            ->get();
        if($productsCart->isEmpty()){
            return [
                'message'   => 'Su carrito está vacío.',
                'status'    => 'error'
            ];
        }
        $productsItems = [];
        foreach ($productsCart as $key => $item) {
            $productsItems[] = [
                'id'  => $item->id,
                'name'  => $item->product->name,
                'count'  => $item->count,
                'url_image'  => $item->product->url_image,
                'product_id'  => $item->product->id,
                'route'         => route('front.shop.show', $item->product->id),
                'price_format'  => $item->price_format,
                'total_format'  => $item->total_format,
            ];
        }
        return [
            'tokenCart'     => $cart->uuid,
            'count'         => $cart->total_items_products,
            'total_format'  => $cart->total_format,
            'products'      => $productsItems,
            'message'       => 'datos encontrados',
            'status'        => 'success'
        ];
    }

    /**
     * @param Request $request 
     * @param CartShop $cart
     */
    public function restoreCartProduct(Request $request, CartShop $cart) {
        $productsShop = $request->input('cart_product');
        if ($productsShop == null || !is_array($productsShop)|| count($productsShop) == 0) {
            return [
                'status'    => 'error',
                'code'      => '404',
                'message'   => 'Productos no encontrados',
            ];
        }
        foreach ($productsShop as $key => $productShopReq) {
            $productCart = $this->cartShopProducts
                ->where('cart_shop_id', $cart->id)
                ->where('id', $productShopReq['item_id'])
                ->with('product')
                ->has('product')
                ->first();
            if($productCart == null){
                continue;
            }
            $productCart->count = 0;
            $productCart = $this->calculateItemValues($productCart, $productShopReq['qty'], $productCart->product);
            $productCart->save();
        }
        $cart = $this->getCartShop($cart->uuid, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product']);
        $this->restoreCart($cart);
        // $cart = $this->getCartShop($cart->uuid, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product']);

        return [
            'status'    => 'success',
            'code'      => '200',
            'message'   => 'Se ha actualizado la sección',
            'total_format'  => $cart->total_format,
            'html_items'  => view('front.pages.cart.body-table')
                ->with('cart', $cart)->render(),
        ];
    }
    /**
     * @param Request $request
     * @param $user_id
     */
    public function addProductToCart(Request $request, $user_id) {
        $cart = $this->getCartShop($request->cart_token, $user_id);

        $productCart = $this->cartShopProducts
            ->where('cart_shop_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();
        // Product
        $product = $this->productModel->find($request->product_id);
        if($productCart == null){
            // Search item
            $productCart = $this->cartShopProducts->create([
                'uuid'                  => $cart->uuid, // Session in local storage
                'cart_shop_id'          => $cart->id, 
                'product_id'            => $request->product_id, 
                'route_image'           => $product->route_image,
                'name'                  => $product->name,
                'description'           => $product->description,
                'count'                 => 0,
                // Money values
                'price_unit'            => $product->price_unit,
                'percentage_tax'        => $product->percentage_tax,
                'total_tax'             => 0,
                'discount_percentage'   => $product->discount_percentage,
                'discount_value'        => 0,
                'total'                 => 0,
                'total_before_tax'      => 0,
                'subtotal_after_tax'    => 0,
                // end money values
                'status'                => ConstantsService::$CART_STATUS_CREATED, // 'created', 'deleted', 'finished'
            ]);
        }
        $productCart = $this->calculateItemValues($productCart, $request->quantity, $product);
        $productCart->save();

        $this->restoreCart($cart);

        return (object)[
            'cart'      => $cart,
            'product'   => $productCart
        ];
    }
    /**
     * @param $productCart
     * @param $quantity
     * @param $product
     */
    private function calculateItemValues($productCart, $quantity, $product) {
        $productCart->count += $quantity;
        $productCart->price = $product->price;
        
        $productCart->subtotal_before_discount = $product->price_unit * $productCart->count;
        // CALC DISCOUNT
        if($productCart->discount_percentage > 0){
            $productCart->discount_value = ($productCart->discount_percentage/100) * $productCart->subtotal_before_discount;
            $productCart->total_before_tax = $productCart->subtotal_before_discount - $productCart->discount_value;
        }else{
            $productCart->total_before_tax = $productCart->subtotal_before_discount;
        }
        // CALC TAXES
        $productCart->total_tax = $productCart->total_before_tax * $product->tax_div;
        // CALC TOTALES
        $productCart->subtotal_after_tax = $productCart->total_tax + $productCart->total_before_tax;
        $productCart->total = $product->price * $productCart->count;
        return $productCart;
    }
    /**
     * @param $cart
     */
    private function restoreCart($cart) {
        $products = $cart->products;
        $this->restoreValuesCart($cart);
        $cart->total_items_products = $products->count();
        foreach ($products as $key => $item) {
            $cart->subtotal_before_discount += $item->subtotal_before_discount ;
            $cart->discount              += $item->discount_value;
            $cart->subtotal              += $item->total_before_tax;
            $cart->total_before_tax      += $item->total_before_tax;
            $cart->percentage_tax        += $item->percentage_tax;
            $cart->total_tax             += $item->total_tax;
            $cart->subtotal_after_tax    += $item->subtotal_after_tax;
            $cart->total                 += $item->total;
            $cart->count_products        += $item->count;
        }
        $cart->save();
    }
    /**
     * @param $cart
     */
    public function restoreValuesCart($cart) {
        $cart->subtotal_before_discount = 0;
        $cart->discount = 0;
        $cart->subtotal = 0;
        $cart->total_before_tax = 0;
        $cart->percentage_tax = 0;
        $cart->subtotal_after_tax = 0;
        $cart->count_products = 0;
        $cart->total_items_products = 0;
        $cart->total_tax = 0;
        $cart->total = 0;
    }

    /**
     * @param $user_id
     */
    public function getPurchases($user_id) {
        $countPaginate = 4;
        $items = $this->cartShop->where('user_id', $user_id)
            ->whereIn('status', [ConstantsService::$CART_STATUS_FINISHED, ConstantsService::$CART_STATUS_CANCELLED])
            ->with(['billing'])
            ->with('products')
            ->with(['billing.country'])
            ->with(['billing.state'])
            ->with(['billing.city'])
            ->orderBy('created_at', 'desc')
            ->paginate($countPaginate);
        return $items;
    }


    /**
     */
    public function getAllPurchases() {
        $countPaginate = 5;
        $items = $this->cartShop
            ->whereIn('status', [ConstantsService::$CART_STATUS_FINISHED, ConstantsService::$CART_STATUS_CANCELLED])
            ->with(['billing'])
            ->with('products')
            ->with(['billing.country'])
            ->with(['billing.state'])
            ->with(['billing.city'])
            ->orderBy('number_order', 'desc');

        if(request('start_date')!= null && request('start_date') != '' && !empty(request('start_date'))){
            $items->whereDate('bought_at', '>=', request('start_date'));
        }
        if(request('end_date')!= null && request('end_date') != '' && !empty(request('end_date'))){
            $items->whereDate('bought_at', '<=', request('end_date'));
        }

        if(request('status_delivery')!= null && request('status_delivery') != '' && !empty(request('status_delivery'))){
            $items->where('status_delivery', request('status_delivery'));
        }
        if(request('client_id')!= null && request('client_id') != '' && !empty(request('client_id'))){
            $items->where('user_id', request('client_id'));
        }
        

        $items = $items->paginate($countPaginate);
        return $items;
    }

    /**
     * @param $transactionKey
     */
    public function getCartByTrCode($transactionKey) {
        $transactionObject = $this->cartShopStore
            ->where('transaction', $transactionKey)
            ->first();

        if($transactionObject == null){
            return null;
        }

        $cart = $this->cartShop
            ->with(['products'=> function($query){
                $query->with('product');
            }])
            ->with(['billing'])
            ->with(['billing.country'])
            ->with(['billing.state'])
            ->with(['billing.city'])
            ->find($transactionObject->shop_cart_id);
        return [
            'cart'  => $cart,
            'transaction'   => $transactionObject
        ];
    }
    /**
     * @param $transactionKey
     * @param $with
     */
    public function getCartByTransaction($transactionKey) {
        $transactionObject = $this->cartShopStore
            ->where('transaction', $transactionKey)
            ->with('products')
            ->first();

        if($transactionObject == null){
            return null;
        }
        $cart = $this->cartShop
            ->with(['products'=> function($query) use($transactionObject){
                $query->with('product')
                    ->withTrashed()
                    ->whereIn('id',$transactionObject->products->map(function($item){ return $item->product_shop_id;}));
            }])
            ->with(['billing'])
            ->find($transactionObject->shop_cart_id);
        return [
            'cart'  => $cart,
            'transaction'   => $transactionObject
        ];
    }

    /**
     * @param $cart
     */
    public function resetPorductsAllowInStore($cart, $transactionObject) {
        $cart->status = ConstantsService::$CART_STATUS_FINISHED;
        $cart->transaction_code = $transactionObject->transaction;
        $cart->bought_at = Carbon::now();
        $cart->save();
        foreach ($cart->products as $key => $productShop) {
            $productShop->status = ConstantsService::$CART_STATUS_FINISHED;
            $productShop->save();
        }
        $this->cartShopProducts->where('cart_shop_id', $cart->id)
            ->where('status', '<>', ConstantsService::$CART_STATUS_FINISHED)
            ->delete();
        
        foreach ($cart->products as $key => $productCart) {
            $productCart->count = 0;
            $elItem = $transactionObject->products->firstWhere('product_shop_id', $productCart->id);
            if($elItem == null){
                continue;
            }
            $productCart = $this->calculateItemValues($productCart, $elItem->count, $productCart->product);
            $productCart->save();
        }

        $cart = $this->cartShop
            ->with(['products', 'products.product'])
            ->find($cart->id);
        $cart->number_order = getLasNumberOrder();
        $this->restoreCart($cart);
    }

    /**
     * @param $token 
     * @param $user_id 
     * @return CartShop
     */
    public function getCartShop($token = null, $user_id = null, $created = true, $with = [])  {

        $cartByToken = null;
        if($token != null){
            $cartByToken = $this->cartShop
                ->where('uuid', $token )
                ->where(function($query){
                    $query->where('status', ConstantsService::$CART_STATUS_CREATED)
                        ->orWhere('status', ConstantsService::$CART_STATUS_PENDING_PAYMENT);
                })
                ->with($with)
                ->first();
        }
        if($cartByToken == null && $user_id != null){
            $cartByToken = $this->cartShop->where('user_id', $user_id )
                ->where(function($query){
                    $query->where('status', ConstantsService::$CART_STATUS_CREATED)
                        ->orWhere('status', ConstantsService::$CART_STATUS_PENDING_PAYMENT);
                })
                ->with($with)
                ->first();
        }
        // Check allowed this user
        if($user_id != null && $cartByToken != null && $cartByToken->user_id != null && $cartByToken->user_id != $user_id){
            $cartByToken = null;
        }

        if($cartByToken == null && $created){
            $cartByToken = $this->cartShop->create([
                'uuid'                  => generateRandomString(75), // Session in local storage
                'user_id'               => $user_id, // default null
                'count_products'        => 0,
                'ip_address'            => getClientIp(),
                // Money values
                'subtotal'              => '0',
                'discount'              => '0',
                'subtotal_after_tax'    => '0',
                'percentage_tax'        => '0',
                'total_tax'             => '0',
                'total'                 => '0',
                // end money values
                'status'                => ConstantsService::$CART_STATUS_CREATED,
            ]);
        }
        return $cartByToken;
    }

    /**
     * @param $id
     */
    public function findCartShop($id, $with = []) {
        return $this->cartShop
            ->with($with)
            ->find($id);
    }
    
    /**
     * @param Request $request 
     * @param $user_id
     */
    public function removeItemToCart(Request $request, $user_id) {
        $cart = $this->getCartShop($request->tokenCart, $user_id, false);
        if ($cart == null) {
            return [
                'status'    => 'error',
                'code'      => '404',
                'message'   => 'Carrito de compras no existe',
            ];
        }

        $productCart = $this->cartShopProducts
            ->where('cart_shop_id', $cart->id)
            ->where('id', $request->product_id)
            ->first();
        
        if($productCart == null){
            return [
                'status'    => 'error',
                'code'      => '404',
                'message'   => 'Producto no encontrado',
            ];
        }
        $productCart->delete();

        $cart = $this->getCartShop($cart->uuid, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product']);
        $this->restoreCart($cart);

        return [
            'status'    => 'success',
            'code'      => '200',
            'message'   => 'Registro eliminado',
            'total_format'  => $cart->total_format,
            'html_items'  => view('front.pages.cart.body-table')
                ->with('cart', $cart)->render(),
        ];
    }
    /**
     * @param $cart
     */
    public function updateBillingInfo(Request $request, $cart)  {
        if($cart->billing == null){
            $billing = $this->cartShopInvoice->newInstance();
            $billing->uuid          = $cart->uuid;
            $billing->cart_shop_id  = $cart->id;
        }else{
            $billing = $cart->billing;

        }
        $billing->user_id       = auth()->check() ? auth()->user()->id : null;
        $billing->identification_number = $request->billing_identification_number;
        $billing->name          = $request->billing_first_name;
        $billing->last_name     = $request->billing_last_name;
        // Location
        $billing->country_id    = $request->billing_country_id;
        $billing->state_id      = $request->billing_state_id;
        $billing->city_id       = $request->billing_city_id;
        $billing->address       = $request->billing_address;
        $billing->apartamento   = $request->billing_apartamento;
        // End location
        $billing->phone         = $request->billing_phone;
        $billing->email         = $request->billing_email;
        $billing->aditional_info= $request->order_comments ?? '';
        $billing->postal_code   = $request->billing_postal_code;
        $billing->business_name = $request->billing_company;
        $billing->save();
        return $billing;
    }

    /**
     * @param $cart
     * @param $status
     */
    public function changeStatusCart($cart, $status) {
        if(!in_array( $status, [  ConstantsService::$CART_STATUS_CREATED, ConstantsService::$CART_STATUS_PENDING_PAYMENT, ConstantsService::$CART_STATUS_FINISHED ])){
            return false;
        }
        DB::beginTransaction();
        try {
            $cart->status = $status;
            foreach ($cart->products as $key => $product) {
                $product->status = $status;
                $product->save();
            }
            $cart->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('No se ha podido actualizar estado del carrito de compras: CartProductService::changeStatusCart', [
                'message'   => $th->getMessage(),
                'code'      => $th->getCode(),
                'line'      => $th->getLine(),
                'trace'     => $th->getTrace()
            ]);
            return false;
        }
        return true;
    }

    /**
     * @param $tokenCart
     * @param $city_id
     */
    public function changeCityRecalculateDelivery($tokenCart, $state_id) {
        $cart = $this->getCartShop($tokenCart, null, false, ['products', 'products.product']);
        if($cart == null){
            return [
                'status'    => 'error',
                'code'      => '404',
                'message'   => 'Carrito de compras no existe',
            ];
        }

        // PRECIO POR DELIVERY
        $city = $this->cityModel->find($state_id);
        if($city == null){
            return [
                'status'    => 'error',
                'code'      => '404',
                'message'   => 'Ciudad no existe',
            ];
        }
        $cart->delivery_cost = $city->delivery_cost;
        $cart->total_more_delivery = $cart->delivery_cost + $cart->total;
        $cart->save();
        $this->changeStatusCart($cart, ConstantsService::$CART_STATUS_PENDING_PAYMENT);

        return [
            'status'    => 'success',
            'code'      => '200',
            'message'   => 'Registro actualizado',
            'html_order'  => view('front.pages.checkout.order-review')
                ->with('cart', $cart)->render(),
        ];
    }

    /**
     * @param $cart
     */
    public function processToPayment($cart) {
        $cart->transaction_code = generateRandomString(5) . $cart->id .generateRandomString(5);
        $cart->save();

        $transactionShop = $this->cartShopStore->create([
            'transaction'   => $cart->transaction_code,
            'shop_cart_id'  => $cart->id
        ]);

        foreach ($cart->products as $key => $productShop) {
            $this->productStore->create([
                'product_shop_id'       => $productShop->id,
                'shop_cart_id'      => $cart->id,
                'transaction'       => $cart->transaction_code,
                'cart_shop_store_id'=> $transactionShop->id,
                'count'             => $productShop->count
            ]);
        }


    }

    /**
     * @param Request $request
     * @param $transaction
     */
    public function validatePayment(Request $request, $transaction) {
        $apiRequestService = new ApiRequestService(config('app.custompay.checkpaymenturl'));
        try {
            $responseApi = $apiRequestService->validatrPayment($request->input('id'), $request->input('clientTransactionId'));
            if(!$responseApi ){
                throw new Exception("No nos hemos podido comunicar con ". config('app.paymentapp') .", por favor, espere la verificación", 1);
            }
            if(!isset($responseApi->statusCode)){
                throw new Exception(isset($responseApi['message'])? $responseApi['message']: 'No hemos recibido alguna respuesta por parte de '. config('app.paymentapp'), 1);
            }
            $transaction->response = $responseApi ? json_encode($responseApi) : null;
            $transaction->request = json_encode([
                'id'            => $request->input('id'),
                'clientTxId'    => $request->input('clientTransactionId')
            ]);
            $transaction->response_id = $request->input('id');
            $transaction->card_type = isset($responseApi->cardType)?   $responseApi->cardType  : null;
            $transaction->last_digits = isset($responseApi->lastDigits)?   $responseApi->lastDigits  : null;
            $transaction->card_brand = isset($responseApi->cardBrand)?   $responseApi->cardBrand  : null;
            $transaction->card_brand_code = isset($responseApi->cardBrandCode)?   $responseApi->cardBrandCode  : null;
            $transaction->amount = isset($responseApi->amount)?   $responseApi->amount : null;
            $transaction->status_pay = isset($responseApi->transactionStatus)?   $responseApi->transactionStatus  : null;
            $transaction->status_pay_code = isset($responseApi->statusCode)?   $responseApi->statusCode  : null;
            $transaction->message = isset($responseApi->message)?   $responseApi->message  : null;
            $transaction->message_code = isset($responseApi->messageCode)?   $responseApi->messageCode  : null;
            
            $transaction->document = isset($responseApi->document)?   $responseApi->document  : null;
            $transaction->currency = isset($responseApi->currency)?   $responseApi->currency  : null;
            $transaction->authorization_code = isset($responseApi->authorizationCode) ? $responseApi->authorizationCode  : null;
            $transaction->save();

            return [
                'response'  => json_encode($responseApi),
                'message'   => 'Transacción '. $transaction->message,
                'continue'  => $responseApi->statusCode == 3,
                'status'    => 'success',
            ];
        } catch (\Throwable $th) {
            // dd($th);
            Log::error($th->getMessage().': CartProductService::validatePayment', [
                'message'   => $th->getMessage(),
                'code'      => $th->getCode(),
                'line'      => $th->getLine(),
                'trace'     => $th->getTrace()
            ]);
            return [
                'status'    => 'error',
                'message'   => $th->getMessage(),
                'continue'  => false
            ];
        }
        
    }
}
