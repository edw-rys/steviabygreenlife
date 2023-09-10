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

if (! function_exists('statusPendingCheck')) {
    function statusPendingCheck() {
        return ConstantsService::$CART_PENDING_CHECK_TRANSFER;
    }
}

if (! function_exists('listStatusesCart')) {
    function listStatusesCart() {
        return [
            [
               'status' => ConstantsService::$CART_PENDING_CHECK_TRANSFER,
               'title'  => trans('global.status-label.'. ConstantsService::$CART_PENDING_CHECK_TRANSFER) 
            ],
            [
                'status' => ConstantsService::$CART_STATUS_CANCELLED,
                'title'  => trans('global.status-label.'. ConstantsService::$CART_STATUS_CANCELLED) 
            ],
            [
                'status' => ConstantsService::$CART_STATUS_FINISHED,
                'title'  => trans('global.status-label.'. ConstantsService::$CART_STATUS_FINISHED) 
            ],
        ];
    }
}