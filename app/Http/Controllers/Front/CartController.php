<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddProductToCartRequest;
use App\Http\Requests\Cart\ChangeCityBillingToCartRequest;
use App\Http\Requests\Cart\ChangeItemsToCartRequest;
use App\Http\Requests\Cart\RemoveItemToCartRequest;
use App\Http\Requests\Cart\SaveTransferRequest;
use App\Http\Requests\Cart\StoreBillingToCartRequest;
use App\Mail\Shop\NotifyOrderMail;
use App\Service\CartProductService;
use App\Service\ConstantsService;
use App\Service\UserService;
use App\Service\UtilsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    private CartProductService $cartProductService;
    private UserService $userService;
    private UtilsService $utilsService;



    public function __construct(
        CartProductService $cartProductService,
        UtilsService $utilsService,
        UserService $userService
        ) {
        $this->cartProductService = $cartProductService;
        $this->utilsService = $utilsService;
        $this->userService = $userService;
    }

    /**
     * @param AddProductToCartRequest $request
     */
    public function addProduct(AddProductToCartRequest $request) {
        $result = $this->cartProductService->addProductToCart($request, auth()->check() ? auth()->user()->id : null);
        return response()->json([
            'message'   => 'Producto agregado',
            'tokenCart' => $result->cart->uuid
        ]);
    }


    public function cart(Request $request) {

        $cart = $this->cartProductService->getProductsByTokenCart($request->tokenCart, auth()->check() ? auth()->user()->id : null);
        if($cart['status'] == 'error'){
            $response = '
            {
                "uid": "'. $request->tokenCart .'",
                "data": {
                    "order": {
                        "no": 0,
                        "funnelStepVariantId": 0,
                        "additionalFields": null,
                        "discount": null,
                        "subTotal": "0.00",
                        "shippingCountries": [
                            "EC"
                        ],
                        "preShippingTaxes": [],
                        "isSampleOrder": false,
                        "total": "0.00",
                        "funnelId": 0,
                        "shippingInfoRequired": true,
                        "extra": null,
                        "id": 168,
                        "shippingOptions": [
                            {
                                "countryCode": "EC",
                                "order": 1,
                                "name": "Envio Guayaquil y Quito",
                                "type": 0,
                                "rangeFrom": 0.0,
                                "rangeTo": null,
                                "cost": 0.0,
                                "kind": "system",
                                "extra": null,
                                "calculated": true,
                                "external": false
                            }
                        ],
                        "subTotalNoDiscount": "0.00",
                        "size": 0,
                        "postShippingTaxes": [],
                        "attributes": {},
                        "collectedFromCustomer": null,
                        "items": [
                        ],
                        "discountValue": 0,
                        "status": "ABANDONED"
                    }
                },
                "success": true,
                "ok": true
            }
            ';
        }else{
            $newListProduts = [];
            foreach ($cart['products'] as $key => $productItem) {
                $newListProduts[] = [

                    "images"    =>  [
                        [
                            "name"=> $productItem['url_image'],
                            "base"=> ""
                        ]
                    ],
                    "quantityAvailable"=> true,
                    "quantity"=> $productItem['count'],
                    "productId"=> $productItem['product_id'],
                    "additions" => [],
                    "saleType"=> "REGULAR",
                    "weight"=> 0.05,
                    "productWithVariations"=> false,
                    "subscription"=> null,
                    "title"=> $productItem['name'] . ' x '. $productItem['count'].'',
                    "type"=> "PHYSICAL",
                    "variation"=> [],
                    "url"=> $productItem['route'],
                    "price" => $productItem['total_format'],
                    "onSale"=> true,
                    "id"=> $productItem['id']
                ];
            }
            $response = '
            {
                "uid": "1c04bf82-3162-438d-ab51-4d7981d50283",
                "data": {
                    "order": {
                        "no": 0,
                        "funnelStepVariantId": 0,
                        "additionalFields": null,
                        "discount": null,
                        "subTotal": 5.33,
                        "shippingCountries": [
                            "EC"
                        ],
                        "preShippingTaxes": [],
                        "isSampleOrder": false,
                        "paymentType": "paypal",
                        "total": 5.33,
                        "funnelId": 0,
                        "shipping": {
                            "countryCode": "EC",
                            "order": 1,
                            "name": "Envio Guayaquil y Quito",
                            "type": 0,
                            "rangeFrom": 0.0,
                            "rangeTo": null,
                            "cost": 0.0,
                            "kind": "system",
                            "extra": null,
                            "calculated": true,
                            "external": false
                        },
                        "shippingInfoRequired": true,
                        "customerEmail": "edw-toni@hotmail.com",
                        "extra": null,
                        "id": 168,
                        "shippingOptions": [
                            {
                                "countryCode": "EC",
                                "order": 1,
                                "name": "Envio Guayaquil y Quito",
                                "type": 0,
                                "rangeFrom": 0.0,
                                "rangeTo": null,
                                "cost": 0.0,
                                "kind": "system",
                                "extra": null,
                                "calculated": true,
                                "external": false
                            }
                        ],
                        "subTotalNoDiscount": "'. $productItem['total_format'].'",
                        "postShippingTaxes": [],
                        "contactId": 11,
                        "created": "08\/08\/2023 10:23 AM",
                        "hasShipping": true,
                        "weight": 0.05,
                        "loginRequired": false,
                        "funnelStepId": 0,
                        "customerName": "edw",
                        "transactionId": "",
                        "clientSessionId": "cart",
                        "size": 1,
                        "paid": false,
                        "items": 
                           '. json_encode($newListProduts).'
                        ,
                        "discountValue": 0,
                        "status": "ABANDONED"
                    }
                },
                "success": true,
                "ok": true
            }
            ';
        }
        return response()->json(
            json_decode($response)
        );
    }

    public function show() {
        $cart = $this->cartProductService->getCartShop(null, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product']);
        if($cart == null){
            return view('front.pages.cart')
                ->with('cart', null);
        }
        if($cart->products->isEmpty()){
            return view('front.pages.cart')
                ->with('cart', null);
        }

        return view('front.pages.cart')
            ->with('cart', $cart);
    }

    /**
     * @param Request $request
     */
    public function getMyItems(Request $request) {

        $cart = $this->cartProductService->getProductsByTokenCart($request->tokenCart, auth()->check() ? auth()->user()->id : null);
        if($cart['status'] == 'error'){
            return response()->json($cart, 404);
        }
        return response()->json($cart, 200);
        
    }

    /**
     * @param ChangeItemsToCartRequest $request
     */
    public function changeItemsProducts(ChangeItemsToCartRequest $request) {
        $cart = $this->cartProductService->getCartShop($request->tokenCart, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product']);
        if($cart == null){
            return response()->json(['message'=> 'Su carrito no fue encontrado'], 400);
        }
        if($cart->products->isEmpty()){
            return response()->json(['message'=> 'Su carrito no tiene productos'], 400);
        }
        $response = $this->cartProductService->restoreCartProduct($request, $cart);
        return response()->json($response, $response['code']);
    }

    /**
     * @param Request $request
     */
    public function getReloadItems(Request $request) {
        $cart = $this->cartProductService->getCartShop($request->tokenCart, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product']);
        if($cart == null){
            return response()->json(['message'=> 'Su carrito no fue encontrado'], 400);
        }
        if($cart->products->isEmpty()){
            return response()->json(['message'=> 'Su carrito no tiene productos'], 400);
        }
        return response()->json(
            [
                'status'    => 'success',
                'code'      => '200',
                'message'   => 'Se ha actualizado la sección',
                'total_format'  => $cart->total_format,
                'html_items'  => view('front.pages.cart.body-table')
                    ->with('cart', $cart)->render(),
            ], 200
        );
    }
    /**
     * @param RemoveItemToCartRequest $request
     */
    public function removeItem(RemoveItemToCartRequest $request) {
        $response = $this->cartProductService->removeItemToCart($request, auth()->check() ? auth()->user()->id : null);
        // $cart = $this->cartProductService->getCartShop($request->tokenCart, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product']);
        return response()->json($response, $response['code']);
    }
    /**
     * 
     */
    public function checkout($token) {
        $cart = $this->cartProductService->getCartShop($token, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product', 'billing']);

        if($cart == null){
            return redirect()->route('front.shop')->with('remove_token', 'yes');
        }
        if($cart->products->isEmpty()){
            return redirect()->route('front.shop')->with('remove_token', 'yes');
        }

        $cart->delivery_cost = 0; 
        if (auth()->check()) {
            $city = $this->userService->getCityByUserId(auth()->user()->id);
            if($city != null){
                $cart->delivery_cost = $city->delivery_cost; 
            }
        }

        $country = $this->utilsService->getMyCountry();

        $cart->total_more_delivery = $cart->delivery_cost + $cart->total;
        $cart->save();

        $this->cartProductService->changeStatusCart($cart, ConstantsService::$CART_STATUS_PENDING_PAYMENT);

        if($cart->billing == null){
            $cart->billing = (object)[
                'user_id'       => auth()->check() ? auth()->user()->id : null, // default null
                'uuid'          => $cart->uuid,
                'cart_shop_id'  => $cart->id,
                'name'          => auth()->check() ? auth()->user()->name : '',
                'last_name'     => auth()->check() ? auth()->user()->name : '',
                // Location
                'country_id'    => auth()->check() ? auth()->user()->country_id : $country->id,
                'state_id'      => auth()->check() ? auth()->user()->state_id : null,
                'city_id'       => auth()->check() ? auth()->user()->city_id : null,
                'address'       => '',
                'apartamento'   => null,
                // End location
    
                'phone'         => null,
                'email'         => auth()->check() ? auth()->user()->email : null,
                'instruction'   => null,
                'business_name' => null,
                'identification_number' => '',
                'postal_code'   => '',
                'aditional_info'=> ''
            ];
            // $cart->billing = $this->cartProductService->createBillingInfo($cart);
        }

        $accountsBank = $this->utilsService->getBankAccounts();
        
        return view('front.pages.checkout')
            ->with('accountsBank', $accountsBank)
            ->with('cart', $cart)
            ->with('country', $country);
    }

    /**
     * @param SaveTransferRequest $request
     */
    public function saveTransfer(SaveTransferRequest $request) {
        $cart = $this->cartProductService->getCartByTransaction($request->clientTransactionId);
        if($cart == null || $cart['cart'] == null){
            return response()->json([
                "status" => "warning",
                "message" => 'No se puede encontrar su carrito de compras',
                "action" => "redirect",
                "url" => route('front.shop')
            ]);
        }
        if($cart['cart']->status == ConstantsService::$CART_STATUS_FINISHED){
            return response()->json([
                "status" => "warning",
                "message" => 'No se puede encontrar su carrito de compras',
                "action" => "redirect",
                "url" => route('front.shop')
            ]);
        }
        set_time_limit(0);
        storage_exists($cart['cart']->id, 'transferencias');

        $files = [];
        foreach($request->file('transferencias') as $key => $file){
            $filename = str_replace( '.'.$file->extension() , '', $file->getClientOriginalName());
            $filename = $filename  .time().rand(1,99).'.'.$file->extension();
            $files[] = [
                'size'              => $file->getSize(),
                'extension'         => $file->extension(),
                'filename'          => $filename,
                'original_name'     => $file->getClientOriginalName()
            ];
            $file->move(storage_path('app/transferencias/').$cart['cart']->id, $filename);
        }
        $this->cartProductService->uploadFilesTransfer($cart['cart']->id, $files);

        $this->cartProductService->resetPorductsAllowInStore( $cart['cart'], $cart['transaction'], ConstantsService::$CART_PENDING_CHECK_TRANSFER);


        // Check user
        if($cart['cart']->user_id == null){
            if(auth()->check()){
                $cart['cart']->user_id = auth()->user()->id;
                $cart['cart']->save();
            }else{
                $randomString = generateRandomString('4');
                $request->merge([
                    'name'      => $cart['cart']->billing->name,
                    'last_name' => $cart['cart']->billing->last_name,
                    'email'     => $cart['cart']->billing->email . '__' . $randomString,
                    'email_shop'=> $cart['cart']->billing->email,
                    'password'  => $cart['cart']->billing->email
                ]);
                $user = $this->userService->create($request, 1);
                $user->email = str_replace('__'.$randomString, '_' .$user->id , $user->email);
                $user->save();
                $cart['cart']->user_id = $user->id;
                $cart['cart']->save();
            }
        }

        // Send mail
        try {
            Mail::to([$cart['cart']->billing->email])
                ->cc(config('app.emails_admin'))
                ->queue( new NotifyOrderMail($cart['cart']));
        } catch (\Throwable $th) {
            Log::error($th->getMessage().': CartController::saveTransfer', [
                'message'   => $th->getMessage(),
                'code'      => $th->getCode(),
                'line'      => $th->getLine(),
                'trace'     => $th->getTrace()
            ]);
        }
        return response()->json([
            "status" => "success",
            "message" => 'Transacción ha sido solicitada para su aprobación',
            "action" => "redirect",
            "url" => route('front.result.pay', ['transaction' => base64_encode($cart['transaction']->transaction) ] )
        ]);
    }

    /**
     * @param 
     */
    public function changeCityRecalculateDelivery(ChangeCityBillingToCartRequest $request) {
        $response = $this->cartProductService->changeCityRecalculateDelivery($request->tokenCart, $request->city_id);
        return response()->json($response, $response['code']);
    }

    /**
     * @param StoreBillingToCartRequest $request
     */
    public function processCheckout(StoreBillingToCartRequest $request) {
        $cart = $this->cartProductService->getCartShop($request->tokenCart, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product', 'billing']);

        if($cart == null){
            return response()->json(['message'=> 'Su carrito de compras no fue encontrado'], 400);
        }
        if($cart->products->isEmpty()){
            return response()->json(['message'=> 'Su carrito de compras no tiene productos'], 400);
        }
        // Save billing info
        $billing = $this->cartProductService->updateBillingInfo($request, $cart);

        $city = $billing->city;
        $cart->delivery_cost = $city->delivery_cost;         
        $cart->total_more_delivery = $cart->delivery_cost + $cart->total;
        $cart->save();

        $this->cartProductService->processToPayment($cart);

        $this->cartProductService->changeStatusCart($cart, ConstantsService::$CART_STATUS_PENDING_PAYMENT);

        $accountsBank = $this->utilsService->getBankAccounts();
        
        return response()->json([
            'total'     => $cart->total_more_delivery_int,
            'tokenCart' => $cart->uuid,
            'html_order'  => view('front.pages.checkout.order-review')
                ->with('process', true)
                ->with('accountsBank', $accountsBank)
                ->with('cart', $cart)->render(),
            'products'  => $cart->products->map(function($item){
                return [
                    'id'    => $item->id,
                    'count'    => $item->count,
                ];
            }),
            'billing'   => [
                'name'  => $billing->name,
                'last_name'  => $billing->last_name,
                'identification_number' => $billing->identification_number,
                'address'               => $billing->address,
                'email'                 => $billing->email,
                'phone'                 => $billing->phone,
            ],
            'payment'   => [
                'id_app'    => config('app.custompay.id_app'),
                'token'     => config('app.custompay.token'),
                'client_id' => $cart->transaction_code,
            ],
            'currency'  => "USD"
        ]);
    }

    /**
     * @param Request $request
     */
    public function checkPay(Request $request) {
        $request->validate([
            'id'    => ['required', 'integer'],
            'clientTransactionId'   => ['required']
        ]);

        $cart = $this->cartProductService->getCartByTransaction($request->clientTransactionId);
        
        if($cart == null || $cart['cart'] == null){
            return redirect()->route('front.shop');
        }
        if($cart['cart']->status == ConstantsService::$CART_STATUS_FINISHED){
            return redirect()->route('front.result.pay', ['transaction' => $cart['transaction']->transaction ] );
        }

        $result = $this->cartProductService->validatePayment($request, $cart['transaction']);
        if(!$result['continue']){
            if($result['status'] == 'error'){
                return redirect()->route('front.result.error_pay');
            }
            return redirect()->route('front.result.pay', ['transaction' => base64_encode($cart['transaction']->transaction) ] );
        }

        $this->cartProductService->resetPorductsAllowInStore( $cart['cart'], $cart['transaction'], ConstantsService::$CART_STATUS_FINISHED);
        // Check user
        if($cart['cart']->user_id == null){
            if(auth()->check()){
                $cart['cart']->user_id = auth()->user()->id;
                $cart['cart']->save();
            }else{
                $randomString = generateRandomString('4');
                $request->merge([
                    'name'      => $cart['cart']->billing->name,
                    'last_name' => $cart['cart']->billing->last_name,
                    'email'     => $cart['cart']->billing->email . '__' . $randomString,
                    'email_shop'=> $cart['cart']->billing->email,
                    'password'  => $cart['cart']->billing->email
                ]);
                $user = $this->userService->create($request, 1);
                $user->email = str_replace('__'.$randomString, '_' .$user->id , $user->email);
                $user->save();
                $cart['cart']->user_id = $user->id;
                $cart['cart']->save();
            }
        }

        // Send mail
        try {
            Mail::to([$cart['cart']->billing->email])
                ->cc(config('app.emails_admin'))
                ->queue( new NotifyOrderMail($cart['cart']));
        } catch (\Throwable $th) {
            Log::error($th->getMessage().': CartController::checkPay', [
                'message'   => $th->getMessage(),
                'code'      => $th->getCode(),
                'line'      => $th->getLine(),
                'trace'     => $th->getTrace()
            ]);
        }
        
        
        return redirect()->route('front.result.pay', ['transaction' => base64_encode($cart['transaction']->transaction) ] )
            ->with('remove_token', 'yes');
    }

    /**
     * @param $transaction
     */
    public function resultPay($transaction) {
        $transaction = base64_decode($transaction);
        $cart = $this->cartProductService->getCartByTrCode($transaction);
        if($cart == null || $cart['cart'] == null){
            abort(404);
        }

        $remove_token = session('remove_token') ?? false;
        if($remove_token == 'yes'){
            session()->forget('remove_token');
        }            
        return view('front.pages.checkout.result')
            ->with('cart', $cart['cart'])
            ->with('transaction', $cart['transaction'])
            ->with('remove_token', $remove_token);
    }
    /**
     * @param Request $request
     */
    public function showErrorPay(Request $request) {
        return view('front.pages.checkout.error');
    }
}
