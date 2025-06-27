<?php

namespace App\Model;

use App\Model\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'pro_id';
    public $incrementing = true; // or false if not auto-increment
    protected $keyType = 'int';  //
    protected static function booted()
    {
        static::saving(function ($product) {
            $product->net_price = $product->original_price * (1 - $product->discount / 100);
        });
    }

    protected $fillable = [
        'pro_img',
        'pro_title_en',
        'pro_title_ar',
        'pro_description_en',
        'pro_description_ar',
        'original_price',
        'discount',
        'quantity',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'cat_id');
    }

    protected $appends = ['price_after_sale'];

    /**
     * ACCESSOR: Calculates the final price after discount.
     * This function runs whenever you access $product->price_after_sale.
     *
     * @return float
     */
    public function getPriceAfterSaleAttribute()
    {
        if ($this->discount > 0) {
            $discountedPrice = $this->original_price - ($this->original_price * ($this->discount / 100));
            return round($discountedPrice, 2);
        }
        return $this->original_price;
    }
}
