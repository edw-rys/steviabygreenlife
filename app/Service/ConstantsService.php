<?php
namespace App\Service;
class ConstantsService
{
    public static $CART_STATUS_CREATED = 'created';
    public static $CART_STATUS_PENDING_PAYMENT = 'pending_payment';
    public static $CART_STATUS_FINISHED = 'finished';
    public static $CART_PENDING_CHECK_TRANSFER = 'pending_check_transfer';
    public static $CART_STATUS_CANCELLED = 'cancelled';
    public static $ROLE_ADMIN = 'admin';
    public static $ROLE_CLIENT = 'client';
}
