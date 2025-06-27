<?php

namespace App\Http\Controllers\UserAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowOneProduct extends Controller
{
    public function showOneProduct($pro_id)
    {
        return view('showoneProduct', $pro_id);
    }
}
