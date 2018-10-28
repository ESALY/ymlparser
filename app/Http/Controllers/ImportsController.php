<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Sirian\YMLParser\Parser;


class ImportsController extends Controller
{

    public function test_import(){

        //Адрес xml для импорта
        $urls = [];
        $urls[] = "http://armprodukt.ru/bitrix/catalog_export/yandex.php";
        $urls[] = "http://static.ozone.ru/multimedia/yml/facet/div_soft.xml";
        $urls[] = "http://www.trenazhery.ru/market2.xml";
        $urls[] = "http://www.radio-liga.ru/yml.php";


        shuffle($urls);

        foreach ($urls as $url){
            print $url . "<br>";
            $this->import($url);
        }

    }

    //Импортируем файлы
    public function import($xmlUrl){

        $yamlArray = [];

        //Десериализация xml в массив
        $xmlObject = simplexml_load_file($xmlUrl,"SimpleXMLElement", LIBXML_NOERROR |  LIBXML_ERR_NONE);
        $json = json_encode($xmlObject);
        $array = json_decode($json,TRUE);

        //Отдельно десериализуем категории для сохранения аттрибутов id и parent id
        $categoriesObject = $xmlObject->xpath("//category");
        $categoriesJson = json_encode($categoriesObject);
        $categoriesArray = json_decode($categoriesJson,TRUE);
        $categoriesArray2 = [];

        foreach ($categoriesArray as $categoryArray){

            $categoryArray2['id'] = $categoryArray['@attributes']['id'];
            $categoryArray2['name'] = $categoryArray[0];
           if(isset($categoryArray['@attributes']['parentId'])){
                $categoryArray2['parent_id'] = $categoryArray['@attributes']['parentId'];
           }

            $categoriesArray2[] = $categoryArray2;
        }

        //dd($xmlObject);
        //dd($array);
        //dd($categoriesArray);

        //Если существуют продукты то добавляем их в базу
        if (isset($array['shop']['offers']['offer'])){

            $yamlArray['shop_name'] = $array['shop']['name'];
            $yamlArray['offers'] = $array['shop']['offers']['offer'];
            $yamlArray['categories'] = $categoriesArray2;
            //dd($yamlArray['offers']);
            $this->importProductsToDb($yamlArray);
        }
    }

    //Добавляем товары в базу данных
    public function importProductsToDb($yamlArray){

        $newOffers = [];
        $newCategories = [];

        $now = Carbon::now('utc')->toDateTimeString();
        $productsIDS = Product::pluck("raw_id");

        foreach ($yamlArray['offers'] as $offer){
            //dd($offer);

            $id = $offer['@attributes']['id'];

            if (isset($offer['name'])) {
                $name = $offer['name'];
            }else{
                $name = $offer['model'];
            }

            if($productsIDS->contains($id) == false){

                if (is_array($offer['categoryId'])) {
                    $newOffer['category_id'] = $offer['categoryId'][0];
                }else{
                    $newOffer['category_id'] = $offer['categoryId'];
                }

                if (isset($offer['picture']) == false) {
                    $newOffer['img'] = '';
                }else{

                    if (is_array($offer['picture'])) {
                        $newOffer['img'] = $offer['picture'][0];
                    }else{
                        $newOffer['img'] = $offer['picture'];
                    }
                }

                if (is_isset($offer['description'])) {
                    $newOffer['description'] = $offer['description'];
                }else{
                    dd($offer);
                }


                $newOffer['raw_id'] = $id;
                $newOffer['name'] = $name;
                $newOffer['shop_id'] = $yamlArray['shop_name'] ;
                $newOffer['price'] = $offer['price'];
                $newOffer['url'] = $offer['url'];
                $newOffer['created_at'] = $now;
                $newOffer['updated_at'] = $now;
                $newOffers[] = $newOffer;
            }
        }

        // //print "ID:{$id} MODEL: {$offer['name']}" . "<br>";

        //Вносим новые товары в базу
        Product::insert($newOffers);

        print "Всего товаров: " . count($yamlArray['offers']) . "<br>";
        print "Импортировано товаров: " . count($newOffers) . "<br>";

        //импорт категорий
        $categoryIDS = Category::pluck("raw_id");

        foreach ( $yamlArray['categories'] as $category){
            //dd($offer['model']);

            $id = $category['id'];
            $name = $category['name'];

            if($categoryIDS->contains($id) == false){

                $newCategory['raw_id'] = $id;
                if(isset($category['parent_id'])) {
                    $newCategory['parent_id'] = $category['parent_id'];
                }else{
                    $newCategory['parent_id'] = null;
                }
                $newCategory['shop_id'] = $yamlArray['shop_name'] ;
                $newCategory['name'] = $name;
                $newCategory['created_at'] = $now;
                $newCategory['updated_at'] = $now;
                $newCategories[] = $newCategory;
            }
        }

        //Вносим новые категории в базу
        Category::insert($newCategories);

        print "Всего категорий: " . count($yamlArray['offers']) . "<br>";
        print "Импортировано категорий: " . count($newOffers) . "<br>";
    }

}
