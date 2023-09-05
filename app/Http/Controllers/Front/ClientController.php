<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Service\CartProductService;
use App\Service\ClientService;
use App\Service\ShopService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private ShopService $shopService;
    private ClientService $clientService;
    private CartProductService $cartProductService;
    

    /**
     * @param ShopService $shopService
     * @param ClientService $clientService
     * @param CartProductService $cartProductService
     */
    public function __construct(ShopService $shopService, ClientService $clientService, CartProductService $cartProductService) {
        $this->shopService = $shopService;
        $this->clientService = $clientService;
        $this->cartProductService = $cartProductService;
    }

   
    public function favorites(Request $request) {
        $products = $this->shopService->getProducts($request, null, null, true);
        return view('front.pages.user.favorites')
            ->with('products', $products);
    }

    public function addFavorites(Request $request, $id) {
        $response = $this->clientService->addProductToFavorite($id, auth()->user()->id);
        return response()->json([
            'action'    => $response
        ]);
    }
    public function shopping(Request $request) {
        $items = $this->cartProductService->getPurchases(auth()->user()->id);
        // dd($items);
        return view('front.pages.user.list-buy')
            ->with('purcharses', $items);
    }
}
