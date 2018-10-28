<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @mixin \Eloquent
 */
class Category extends Model
{
    //Разрешаем массовое заполнение
    protected $fillable = [
        "raw_id",
        "name"
    ];
}
