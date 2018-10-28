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

        $products = Product::where('name','LIKE','%'.$name.'%')
            //->join('categories', 'products.category_id', '=', 'categories.raw_id')
            //->select('products.*','categories.parent_id')
            ->limit(50)->get();
        return json_encode($products);
    }
}
