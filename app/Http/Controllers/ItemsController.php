<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    //
    public function items_get(){

        $products = Product::limit(100)->get();

       return json_encode($products);
    }
}
