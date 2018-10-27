<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
    //Разрешаем массовое заполнение
    protected $fillable = [
        "raw_id",
        "name"
    ];
}
