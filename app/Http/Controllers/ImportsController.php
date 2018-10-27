<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportsController extends Controller
{
    //Импортируем файлы
    public function import(){
        //Адрес xml для импорта
        $xmlUrl = "http://www.trenazhery.ru/market2.xml";

        //Десериализация xml в массив
        $xmlObject = simplexml_load_file($xmlUrl);
        $json = json_encode($xmlObject);
        $array = json_decode($json,TRUE);

        dd($array['shop']['offers']['offer'][0]['@attributes']);

        //Если существуют продукты то добавляем их в базу
        if (isset($array['shop']['offers'])){
            $this->importProductsToDb($array);
        }

        print 123;
    }

    //Добавляем товары в базу данных
    public function importProductsToDb($array){

        foreach ($array['shop']['offers'] as $product){
            print "{$product['model']}" . "<br>";
        }
    }

}
