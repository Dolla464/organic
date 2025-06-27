<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            "Id"=>$this->cat_id,
            "Image URL"=>$this->cat_image,
            "Title_en"=>$this->cat_title_en,
            "Title_ar"=>$this->cat_title_ar,
            "Description_en"=>$this->cat_description_en,
            "Description_ar"=>$this->cat_description_ar,
            "Discount"=>$this->discount,
            "Created_at"=>$this->created_at,
            "Updated_at"=>$this->updated_at,
        ];
    }
}
