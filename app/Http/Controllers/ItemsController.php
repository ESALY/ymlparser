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
       $limit = 50;

        $products = Product::select('products.*','categories.name as cat_name')
            ->join('categories', 'products.category_id', '=', 'categories.raw_id')
            ->where('products.name','LIKE','%'.$search.'%')
            ->orWhere('categories.name','LIKE','%'.$search.'%')
            ->orWhere('products.raw_id','LIKE','%'.$search.'%')
            ->orderBy('products.name','asc')
            ->limit($limit)
            ->get();
        return $products->toJson();
    }

    public function item_get($id){
        $product = Product::find($id)->first();
        return view('product',['product' => $product]);
    }
}
