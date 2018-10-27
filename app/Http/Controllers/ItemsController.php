<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    //
    public function items_get($params){

        $searchString = $params;
        $products = Product::where('name','LIKE','%'.$searchString.'%')->limit(100)->get();
       return json_encode($products);
    }
}
