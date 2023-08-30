<?php
use Illuminate\Support\Facades\Route;
if (! function_exists('currentRoute')) {
    function currentRoute(){
        return route(Route::currentRouteName(), Route::current()->parameters());
    }
}