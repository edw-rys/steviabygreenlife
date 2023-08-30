<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private ShopService $shopService;
    public function __construct(
        ShopService $shopService
    ) {
        $this->shopService = $shopService;
    }

    public function index(Request $request, $category = null) {
        $categories = $this->shopService->getCategories($request);
        $products = $this->shopService->getProducts($request, $category);
        return view('front.pages.shop')
            ->with('products',$products)
            ->with('categories',$categories);
    }

    function show(Request $request, $id) {
        $product = $this->shopService->findProduct($id);
        $productsBeLink = null;
        if($product->category != null){
            $productsBeLink = $this->shopService->getProducts($request, $product->category->system_name, $id);
        }

        return view('front.pages.product')
            ->with('product', $product)
            ->with('productsBeLink', $productsBeLink);
    }
}
