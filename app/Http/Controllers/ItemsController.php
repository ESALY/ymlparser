<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    //
    public function items_get(Request $request){

       $inputArray = $request->all();
       $name = $inputArray['name'];

        $products = Product::select('products.*','categories.name as cat_id')
            ->join('categories', 'products.category_id', '=', 'categories.raw_id')
            ->where('products.name','LIKE','%'.$name.'%')
            ->limit(50)->get();
        return json_encode($products);
    }

    public function items_get2(){


        $name = '';

        $products = Product::select('products.*','categories.name as cat_id')
            ->join('categories', 'products.category_id', '=', 'categories.raw_id')
            ->where('products.name','LIKE','%'.$name.'%')
            ->limit(50)->get();
        return json_encode($products);
    }
}
