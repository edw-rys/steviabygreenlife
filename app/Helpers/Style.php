<?php

use App\Service\ConstantsService;

if (! function_exists('colorStatusStore')) {
    function colorStatusStore($status) {
        switch ($status) {
            case ConstantsService::$CART_STATUS_FINISHED:
                return '#44E700';
            case ConstantsService::$CART_STATUS_CANCELLED:
                return '#FF5E5E';
        }
        return '#fff';
    }
}

if (! function_exists('badgeStatusStore')) {
    function badgeStatusStore($status) {
        switch ($status) {
            case ConstantsService::$CART_STATUS_FINISHED:
                return 'badge-success';
            case ConstantsService::$CART_STATUS_CANCELLED:
                return 'badge-danger';
        }
        return '#fff';
    }
}
