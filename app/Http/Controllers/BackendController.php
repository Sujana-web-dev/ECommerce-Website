<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function admindashboard()
    {
        $pageTitle = "Home";
        return view('admin.index', compact('pageTitle'));
    }
    public function cart()
    {
        $cart = session()->get('cart', []); // get cart from session
        $pageTitle = "Cart"; // optional, for your Blade
        return view('admin.cart', compact('cart', 'pageTitle'));
    }
     
}
