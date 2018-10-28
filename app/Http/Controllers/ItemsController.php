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
       $limit = 10;

       if($name !== ''){
           $limit = 1000;
       }

        $products = Product::select('products.*','categories.name as cat_name')
            ->join('categories', 'products.category_id', '=', 'categories.raw_id')
            ->where('products.name','LIKE','%'.$name.'%')
            ->orWhere('categories.name','LIKE','%'.$name.'%')
            ->orWhere('products.raw_id','LIKE','%'.$name.'%')
            ->limit(50)
            ->get();
        return json_encode($products);
    }

    public function item_get($id){
        return view('product');
    }
}
