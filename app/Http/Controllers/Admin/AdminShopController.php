<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\CartProductService;
use App\Service\ConstantsService;
use App\Service\ShopService;
use App\Service\UtilsService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class AdminShopController extends Controller
{
    private ShopService $shopService;
    private UtilsService $utilsService;
    private CartProductService $cartProductService;


    /**
     * @param ShopService $shopService
     * @param CartProductService $cartProductService
     */
    public function __construct(ShopService $shopService, CartProductService $cartProductService, UtilsService $utilsService) {
        $this->shopService = $shopService;
        $this->utilsService = $utilsService;
        $this->cartProductService = $cartProductService;
    }


    function index() {
        $items = $this->cartProductService->getAllPurchases();
        $statusesDelivery = $this->utilsService->getStatusesDelivery();

        return view('front.admin.pages.list-buy')
            ->with('statusesDelivery', $statusesDelivery)
            ->with('purcharses', $items);
    }

    /**
     * Cancel a order
     * @param $id
     */
    public function cancelOrder($id) {
        $cart = $this->cartProductService->findCartShop($id);
        if(!$cart ){
            return response()->json([
                'message'   => 'La orden no ha sido encontrada.'
            ], 404);
        }
        $cart->status = ConstantsService::$CART_STATUS_CANCELLED;
        $cart->save();
        return response()->json([
            'message'   => 'La orden ha sido cancelada, recargando la página...'
        ]);
    }

    /**
     * @param Request $request
     */
    public function changeStatusDelivery(Request $request) {
        $request->validate([
            'cart_id'       => ['required', new Exists('cart_shop','id')],
            'status_id'     => ['required', new Exists('status_delivery','id')],
        ]);
        $cart = $this->cartProductService->findCartShop($request->cart_id, ['products', 'products.product', 'billing']);
        $statusObject = $this->utilsService->findStatusDelivery($request->status_id);
        $statusesDelivery = $this->utilsService->getStatusesDelivery();

        $cart->status_delivery = $statusObject->code;
        $cart->status_delivery_lang = $statusObject->title;
        $cart->status_delivery_color = $statusObject->color;
        $cart->save();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Se ha actualizado el estado de envío',
            'cart_html' => view('front.admin.pages.shop.item-buy-card')
                ->with('cart', $cart)
                ->with('statusesDelivery', $statusesDelivery)
                ->render()
        ]);
    }
}
