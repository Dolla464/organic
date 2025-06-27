<?php

namespace App\Http\Controllers\UserAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowOneCategory extends Controller
{
    public function showOneCategory($cat_id)
    {
        return view('showonecategory', $cat_id);
    }
}
