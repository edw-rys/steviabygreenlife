<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Service\ClientService;
use App\Service\ShopService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private ShopService $shopService;
    private ClientService $clientService;
    

    /**
     * @param ShopService $shopService
     * @param ClientService $clientService
     */
    public function __construct(ShopService $shopService, ClientService $clientService) {
        $this->shopService = $shopService;
        $this->clientService = $clientService;
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
    }
}
