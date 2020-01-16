<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class Product extends Model
{
    const IMG_WIDTH = 540;
    const IMG_HEIGHT = 680;
    const THUMB_WIDTH = 255;
    const THUMB_HEIGHT = 320;


    protected $fillable = [
        'name',
        'price',
        'price_promo',
        'description',
        'photo',
        'slug'
    ];

    public function makeThumb($productname, $file){

        if(File::exists(public_path('uploads/' . $this->photo))){
            File::delete([
                public_path('uploads/' . $this->photo),
                public_path('uploads/thumbs/' . $this->photo)
            ]);
        }

        $name = Str::slug($productname) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('', $name, 'public_uploads');

        $filepath = public_path('uploads/' . $name);
        $thumbnailpath = public_path('uploads/thumbs/' . $name);
        Image::make($filepath)->fit(self::IMG_WIDTH, self::IMG_HEIGHT)->save($filepath)
            ->fit(self::THUMB_WIDTH, self::THUMB_HEIGHT)->save($thumbnailpath);

        $this->update(['photo' => $name ]);
    }

    public function deleteThumb(){
        File::delete([
            public_path('uploads/' . $this->photo),
            public_path('uploads/thumbs/' . $this->photo)
        ]);
    }
}
