<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    const IMG_WIDTH = 540;
    const IMG_HEIGHT = 680;
    const THUMB_WIDTH = 255;
    const THUMB_HEIGHT = 320;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'description',
        'photo',
        'slug'
    ];
}
