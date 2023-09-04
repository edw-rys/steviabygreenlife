<?php 
namespace App\Service;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ShopService 
{
    private CategoryProduct $categoryProductMode;
    private Product $productModel;

    
    public function __construct(
        CategoryProduct $categoryProductMode,
        Product         $productModel
    ) {
        $this->categoryProductMode = $categoryProductMode;
        $this->productModel = $productModel;
    }

    /**
     * @param Request $request
     * @param $category
     * @param $except_id
     * @param $myFavorites
     */
    public function getProducts(Request $request, $category, $except_id = null, $myFavorites = false) {
        // return $this->fakeProducts();
        $countPaginate = 15;

        $products = $this->productModel->newQuery();
        if($category != null && !empty($category) && $category != 'all'){
            $categorySearch = $this->categoryProductMode->where('system_name', $category)->first();
            if($categorySearch != null){   
                $products = $products->where('category_id', $categorySearch->id);
            }
        }

        if($request->input('orderby') != null && !empty($request->input('orderby')) && $request->input('orderby') != ''){
            $sortList = explode('-',$request->input('orderby'));
            if (isset($sortList[0]) && Schema::hasColumn('products', $sortList[0])){
                $ascDesc = isset($sortList[1]) && $sortList[1] == 'desc' ? 'desc' :  'asc';
                if($sortList[0] == 'price'){
                    $sortList[0] = 'CAST(price as unsigned) '. $ascDesc;
                    $products->orderByRaw($sortList[0] );
                    
                }else{
                    $products->orderBy($sortList[0], $ascDesc);
                }
            }
        }else{
            $products->orderBy('order_index', 'asc');
        }
        if($request->input('s') != null && !empty($request->input('s')) && $request->input('s') != ''){
            $products->where('name', 'like','%'. $request->input('s') .'%');
        }
        if($except_id != null){
            $products->where('id', '!=', $except_id);
        }
        if(auth()->user() != null){
            $products->withCount(['favorites' => function($query){
                $query->where('user_id', auth()->user()->id);
            }]);
            if($myFavorites){
                $products->having('favorites_count', '>', 0);
            }
        }
        $products = $products->paginate($countPaginate);

        return (object)[
            'count'         => $products->total(),
            'items'         => $products->items(),
            'currentPage'   => $products->currentPage(),
            'lastPaginate'  => $products->lastPage(),
            'showStart'     => ($products->currentPage()-1)*$countPaginate +1,
            'showEnd'       => ($products->currentPage()-1)*$countPaginate + count($products->items()),
            'paginator'     => $products
        ];
    }

    /**
     * @param Request $request
     */
    public function getCategories(Request $request) {
        return $this->categoryProductMode->all();
    }

    /**
     * @param $id
     */
    public function findProduct($id) {
        return $this->productModel
            ->find($id);
    }


    
}
