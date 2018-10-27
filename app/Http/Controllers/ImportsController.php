<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportsController extends Controller
{
    //Импортируем файлы
    public function import(){
        //Адерс xml для импорта
        $xmlUrl = "http://static.ozone.ru/multimedia/yml/facet/div_soft.xml";

        $xmlObject = simplexml_load_file($xmlUrl);
        $json = json_encode($xmlObject);
        $array = json_decode($json,TRUE);

        dd($array);

        print 123;
    }
}
