<?php

use App\Models\CartShop;

if (! function_exists('getLasNumberOrder')) {
    function getLasNumberOrder() {
        $result = CartShop::select('number_order')
            ->whereNotNull('number_order')
            ->orderBy('number_order')->take('1')->first();
        if($result == null){
            return 1;
        }
        return $result->number_order + 1 ;
    }
}