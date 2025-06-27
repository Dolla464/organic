<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            "Id"=>$this->pro_id,
            "Image URL"=>$this->pro_img,
            "Title_en"=>$this->pro_title_en,
            "Title_ar"=>$this->pro_title_ar,
            "Description_en"=>$this->pro_description_en,
            "Description_ar"=>$this->pro_description_ar,
            "Original_Price"=>$this->original_price,
            "Discount"=>$this->discount,
            "Price_after_Sale"=>$this->net_price,
            "Quantity"=>$this->quantity,
            "Category_ID"=>$this->category_id,
            "Created_at"=>$this->created_at,
            "Updated_at"=>$this->updated_at,
        ];
    }
}