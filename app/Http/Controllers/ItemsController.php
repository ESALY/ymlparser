<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller
{
    //
    public function items_get(){
        $array = [1,2,2];

       return json_encode($array);
    }
}
