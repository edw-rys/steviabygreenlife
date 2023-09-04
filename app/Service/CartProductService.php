<?php 
namespace App\Service;

use App\Models\CartShop;
use App\Models\CartShopInvoice;
use App\Models\CartShopProducts;
use App\Models\CategoryProduct;
use App\Models\Location\City;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class CartProductService 
{
    private Product $productModel;
    private CartShop $cartShop;
    private CartShopInvoice  $cartShopInvoice;
    private CartShopProducts $cartShopProducts;
    private City $cityModel;

    
    public function __construct(
        CartShopProducts $cartShopProducts,
        CartShopInvoice  $cartShopInvoice,
        CartShop         $cartShop,
        Product          $productModel,
        City         $cityModel
    ) {
        $this->cartShop = $cartShop;
        $this->productModel = $productModel;
        $this->cartShopInvoice = $cartShopInvoice;
        $this->cartShopProducts = $cartShopProducts;
        $this->cityModel = $cityModel;
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
        $this->restoreCart($cart);
        $cart = $this->getCartShop($cart->uuid, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product']);

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
     * @param $token 
     * @param $user_id 
     * @return CartShop
     */
    public function getCartShop($token = null, $user_id = null, $created = true, $with = []) : CartShop {

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
    public function createBillingInfo($cart) : CartShopInvoice {
        return $this->cartShopInvoice->create([
            'user_id'       => auth()->check() ? auth()->user()->id : null, // default null
            'uuid'          => $cart->uuid,
            'cart_shop_id'  => $cart->id,
            'name'          => auth()->check() ? auth()->user()->name : '',
            'last_name'     => auth()->check() ? auth()->user()->name : '',
            // Location
            'country_id'    => auth()->check() ? auth()->user()->country_id : null,
            'state_id'      => auth()->check() ? auth()->user()->state_id : null,
            'city_id'       => auth()->check() ? auth()->user()->city_id : null,
            'address'       => '',
            'apartamento'   => null,
            // End location

            'phone'         => null,
            'email'         => auth()->check() ? auth()->user()->email : null,
            'instruction'   => null,
            'postal_code'   => null,
            'business_name' => null,
        ]);
    }

    /**
     * @param $cart
     * @param $status
     */
    public function changeStatusCart($cart, $status) {
        if(!in_array( $status, [  ConstantsService::$CART_STATUS_CREATED, ConstantsService::$CART_STATUS_PENDING_PAYMENT, ConstantsService::$CART_STATUS_PENDING_FINISHED ])){
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
    public function changeCityRecalculateDelivery($tokenCart, $city_id) {
        $cart = $this->getCartShop($tokenCart, null, false, ['products', 'products.product']);
        if($cart == null){
            return [
                'status'    => 'error',
                'code'      => '404',
                'message'   => 'Carrito de compras no existe',
            ];
        }
        $city = $this->cityModel->find($city_id);
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
}
