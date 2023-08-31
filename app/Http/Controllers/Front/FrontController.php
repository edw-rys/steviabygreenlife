<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    
    public function index() {
        return view('front.pages.home');
    }
    public function terms() {
        return view('front.pages.terms');
    }
    public function front() {
        return view('front.pages.index');
    }
}
