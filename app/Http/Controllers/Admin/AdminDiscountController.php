<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\StoreDiscountRequest;
use App\Mail\Shop\NotifyOrderMail;
use App\Service\CartProductService;
use App\Service\ConstantsService;
use App\Service\ShopService;
use App\Service\UtilsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminDiscountController extends Controller
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


    public function index() {
        $list = $this->utilsService->discountList();
        return view('front.admin.pages.discounts.list-discounts')
            ->with('discounts', $list);
    }

    public function create() {
        return view('front.admin.pages.discounts.create-discounts');
    }

    public function store(StoreDiscountRequest $request) {
        $this->utilsService->createDiscount($request);
        return response()->json([
            "status" => "success",
            "message" => '¡Código creado con éxito!',
            "action" => "redirect",
            "url" => route('admin.discount.index')
        ]);
    }

    public function delete($id) {
        $result = $this->utilsService->destoryDiscount($id);
        if($result == null){
            return response()->json([
                "status" => "error",
                "message" => '¡Código no encontrado!',
            ], 404);
        }
        return response()->json([
            "status" => "success",
            "message" => '¡Código eliminado con éxito!',
            "action" => "redirect",
            "url" => route('admin.discount.index')
        ]);
    }
}
