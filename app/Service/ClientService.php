<?php
namespace App\Service;

use App\Models\ClientEventsViewsSystem;
use App\Models\FavoriteProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientService 
{

    private ClientEventsViewsSystem $clientEventsViewsSystem;
    private FavoriteProducts $favoriteProducts;
    public function __construct(
        ClientEventsViewsSystem $clientEventsViewsSystem,
        FavoriteProducts $favoriteProducts
    ) {
        $this->clientEventsViewsSystem = $clientEventsViewsSystem;
        $this->favoriteProducts = $favoriteProducts;
    }


    function saveLogVisit(Request $request) {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->clientEventsViewsSystem->create([
            'action'        => $request->action,
            'context'       => $request->context,
            'user_id'       => auth()->user() != null ? auth()->user()->id : null, 
            'ip_address'    => getClientIp(),
            'browser'       => getBrowser($user_agent),
            'operative_system'    => getOS($user_agent),
            'user_agent'    => $user_agent,
            'canal'         => $request->headers->get('canal_head') ?? 'web',
            'resource_id'   => $request->resource_id,
            'time_action'   => null,
            'start_date'    => $request->start_date != null ? $request->start_date : Carbon::now(),
            'end_date'      => null,
            'authorization' => $request->headers->get('Authorization'),
        ]);
    }

    /**
     * @param $product_id
     * @param $user_id
     */
    public function addProductToFavorite($product_id, $user_id) {
        $myFavorite = $this->favoriteProducts->where('product_id',$product_id)->where('user_id', $user_id)->first();
        if($myFavorite != null){
            $myFavorite->delete();
            return 'remove';
        }
        try {
            $this->favoriteProducts->create([
                'product_id'    => $product_id,
                'user_id'       => $user_id
            ]);
        } catch (\Throwable $th) {
            return '';
        }
        return 'add';
    }
}
