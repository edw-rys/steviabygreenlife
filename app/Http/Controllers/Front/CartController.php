<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddProductToCartRequest;
use App\Http\Requests\Cart\ChangeCityBillingToCartRequest;
use App\Http\Requests\Cart\ChangeItemsToCartRequest;
use App\Http\Requests\Cart\RemoveItemToCartRequest;
use App\Service\CartProductService;
use App\Service\ConstantsService;
use App\Service\UserService;
use App\Service\UtilsService;
use Illuminate\Http\Request;

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


    public function cart() {
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
                    "subTotalNoDiscount": 5.33,
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
                    "postShippingTaxes": [],
                    "meta": {
                        "mailchimpLists": null,
                        "getresponseLists": null,
                        "activecampaignLists": null,
                        "mailerliteLists": null,
                        "moosendLists": null,
                        "aweberLists": null,
                        "keapLists": null,
                        "marketingLists": null,
                        "tags": null,
                        "autoresponderFields": null,
                        "courier": null,
                        "trackingNo": null,
                        "trackingUrl": null,
                        "doubleOptIn": false,
                        "collectedFromCustomer": null,
                        "notes": null,
                        "renewal": false,
                        "extra": null
                    },
                    "paid": false,
                    "shippingAddress": {
                        "name": "",
                        "phone": "",
                        "companyName": "",
                        "companyId": "",
                        "vatId": "",
                        "country": "EC",
                        "state": "Guayas",
                        "city": "Guayaquil",
                        "zipCode": "091003",
                        "address": "Cerecita",
                        "address2": ""
                    },
                    "attributes": {},
                    "billingAddress": {
                        "name": "",
                        "phone": "",
                        "companyName": "",
                        "companyId": "",
                        "vatId": "",
                        "country": "EC",
                        "state": "Guayas",
                        "city": "Guayaquil",
                        "zipCode": "091003",
                        "address": "Cerecita",
                        "address2": ""
                    },
                    "collectedFromCustomer": null,
                    "items": [
                        {
                            "images": [
                                {
                                    "name": "Productos_Tienda/DSC08429-3218830.png",
                                    "base": "s/73296972938990007/"
                                },
                                {
                                    "name": "Productos_Tienda/stevia_powder-05-3119865.png",
                                    "base": "s/73296972938990007/"
                                }
                            ],
                            "quantityAvailable": true,
                            "quantity": 1,
                            "productId": 3,
                            "additions": [],
                            "saleType": "REGULAR",
                            "weight": 0.05,
                            "productWithVariations": false,
                            "subscription": null,
                            "title": "Stevia Powder 50 sobres",
                            "type": "PHYSICAL",
                            "variation": [],
                            "url": "stevia-powder50sobres",
                            "token": null,
                            "isSubscription": false,
                            "price": 5.33,
                            "bump": false,
                            "onSale": true,
                            "id": 214,
                            "sku": "",
                            "combination": -1,
                            "basePrice": 5.92
                        }
                    ],
                    "discountValue": 0,
                    "status": "ABANDONED"
                }
            },
            "success": true,
            "ok": true
        }
        ';
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
    public function checkout() {
        $cart = $this->cartProductService->getCartShop(null, auth()->check() ? auth()->user()->id : null, false, ['products', 'products.product', 'billing']);
        if($cart == null){
            return redirect()->route('cart.shop');
        }
        if($cart->products->isEmpty()){
            return redirect()->route('cart.shop');
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
                'postal_code'   => '',
                'aditional_info'=> ''
            ];
            // $cart->billing = $this->cartProductService->createBillingInfo($cart);
        }

        
        return view('front.pages.checkout')
            ->with('cart', $cart)
            ->with('country', $country);
    }

    public function changeCityRecalculateDelivery(ChangeCityBillingToCartRequest $request) {
        $response = $this->cartProductService->changeCityRecalculateDelivery($request->tokenCart, $request->city_id);
        return response()->json($response, $response['code']);
    }
}
