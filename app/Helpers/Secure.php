<?php

use App\Service\ConstantsService;

if (! function_exists('getAdminName')) {
    function getAdminName() {
        return ConstantsService::$ROLE_ADMIN;
    }
}




if (! function_exists('statusCancelled')) {
    function statusCancelled() {
        return ConstantsService::$CART_STATUS_CANCELLED;
    }
}