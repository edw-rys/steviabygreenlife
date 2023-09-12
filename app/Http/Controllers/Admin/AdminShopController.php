<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Shop\NotifyOrderMail;
use App\Service\CartProductService;
use App\Service\ConstantsService;
use App\Service\ShopService;
use App\Service\UtilsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
            ->with('statusesCart', listStatusesCart())
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
     * Aceptar orden
     * @param $id
     */
    public function acceptOrder($id) {
        $cart = $this->cartProductService->findCartShop($id, ['billing', 'products', 'products.product','discountCart']);
        if(!$cart ){
            return response()->json([
                'message'   => 'La orden no ha sido encontrada.'
            ], 404);
        }
        $cart->status = ConstantsService::$CART_STATUS_FINISHED;
        $cart->save();

        // Send mail
        try {
            Mail::to([$cart->billing->email])
                ->cc(config('app.emails_admin'))
                ->queue( new NotifyOrderMail($cart, 'Su compra ha sido aceptada en stevia'));
        } catch (\Throwable $th) {
            Log::error($th->getMessage().': CartController::acceptOrder', [
                'message'   => $th->getMessage(),
                'code'      => $th->getCode(),
                'line'      => $th->getLine(),
                'trace'     => $th->getTrace()
            ]);
        }

        return response()->json([
            'message'   => 'La orden ha sido aceptada, recargando la página...'
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
    /**
     * @param $id
     */
    public function showFile($id) {
        $fileData = $this->cartProductService->getFileById($id);
        if($fileData == null){
            abort(404);
        }
        $filename = $fileData->cart_shop_id . '/'.$fileData->filename;
        if (!Storage::disk('transferencias')->exists($filename)) {
            abort(404);
        }
        $file = Storage::disk('transferencias')->get($filename);
        
        $type = Storage::disk('transferencias')->mimeType($filename);

        $response = response()->make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function discountCodes(Request $request) {
        $list = $this->utilsService->discountList();
        return view('front.admin.pages.list-discounts')
            ->with('discounts', $list);
    }
}
