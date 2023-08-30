<?php
if (! function_exists('twoDecimal')) {
    /**
     * @param $number
     */
    function twoDecimal($number )
    {
        try {
            return bcdiv($number, '1',2);
            //code...
        } catch (\Throwable $th) {
            // return $number;
            return '0.00';
        }
    }
}
if (! function_exists('twoStringDecimal')) {
    /**
     * @param $number
     */
    function twoStringDecimal($number )
    {
        return twoDecimal($number);
    }
}