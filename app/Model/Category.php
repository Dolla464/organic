<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'cat_id';
    protected $fillable = [
        'cat_id','cat_image','cat_title_en','cat_title_ar','cat_description_en','cat_description_ar','discount','parent_id'
    ];
}
