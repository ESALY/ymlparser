<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    //
    public function items_get(Request $request){

       $inputArray = $request->all();
       $search = $inputArray['name'];
       $limit = 10;

       if($search !== ''){
           $limit = 1000;
       }

        $products = Product::select('products.*','categories.name as cat_name')
            ->join('categories', 'products.category_id', '=', 'categories.raw_id')
            ->where('products.name','LIKE','%'.$search.'%')
            ->orWhere('categories.name','LIKE','%'.$search.'%')
            ->orWhere('products.raw_id','=',$search)
            ->limit($limit)
            ->get();
        return json_encode($products);
    }

    public function item_get($id){
        return view('product');
    }
}
