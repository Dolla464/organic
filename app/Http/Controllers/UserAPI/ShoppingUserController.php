<?php

namespace App\Http\Controllers\UserAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoppingUserController extends Controller
{
    function showAllProducts()
    {
        return view('shoppinguser');
    }
}
