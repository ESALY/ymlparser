<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImportsController extends Controller
{

    public function test_import(){

        //Адрес xml для импорта
        $urls = [];
        $urls[] = "http://static.ozone.ru/multimedia/yml/facet/div_soft.xml";
        $urls[] = "http://www.trenazhery.ru/market2.xml";
        $urls[] = "http://www.radio-liga.ru/yml.php";
        $urls[] = "http://armprodukt.ru/bitrix/catalog_export/yandex.php";

        foreach ($urls as $url){
            print $url . "<br>";
            $this->import($url);
        }

    }

    //Импортируем файлы
    public function import($xmlUrl){

        //$flight = Product::firstOrCreate((array('raw_id' => 10)),(array('raw_id' => 11,'name' => 11)));
        //Десериализация xml в массив
        $xmlObject = simplexml_load_file($xmlUrl);
        $json = json_encode($xmlObject);
        $array = json_decode($json,TRUE);

        //dd($array);

        //dd($array['shop']['offers']['offer'][0]['@attributes']);

        //Если существуют продукты то добавляем их в базу
        if (isset($array['shop']['offers']['offer'])){
            $this->importProductsToDb($array);
        }

       // print 123;
    }

    //Добавляем товары в базу данных
    public function importProductsToDb($array){

        $now = Carbon::now('utc')->toDateTimeString();
        $offers = $array['shop']['offers']['offer'];

        //dd($offers);

        $productsIDS = Product::pluck("raw_id");
        $newOffers = [];

        foreach ($offers as $offer){
            //dd($offer['model']);

            $id = $offer['@attributes']['id'];

            if (isset($offer['name'])) {
                $name = $offer['name'];
            }else{
                $name = $offer['model'];
            }

            if($productsIDS->contains($id) == false){
                $newOffer['raw_id'] = $id;
                $newOffer['name'] = $name;
                $newOffer['created_at'] = $now;
                $newOffer['updated_at'] = $now;
                $newOffers[] = $newOffer;
            }
        }

        // //print "ID:{$id} MODEL: {$offer['name']}" . "<br>";

        //Вносим новые данные в базу
        Product::insert($newOffers);

        print "Всего товаров: " . count($offers) . "<br>";
        print "Импортировано: " . count($newOffers) . "<br>";
    }

}
