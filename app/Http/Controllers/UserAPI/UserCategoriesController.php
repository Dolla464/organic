<?php

namespace App\Http\Controllers\UserAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserCategoriesController extends Controller
{
    function showCategoriesPage ()
    {
        return view('categoryuser');
    }
}
