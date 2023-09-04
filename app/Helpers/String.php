<?php
if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10) {
        $characters = '012345$6789abcdefghijklmno.pqrs$tuvwxyzABCDEFGHI$JKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}