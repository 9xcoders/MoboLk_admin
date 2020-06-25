<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVersion extends Model
{
    protected $table = 'product_versions';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'price', 'off_price', 'in_stock', 'product_id', 'features', 'unique_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productFeatures()
    {
        return $this->hasMany(ProductFeature::class, 'product_id')->where('is_version', true);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id')->where('is_version', true);
    }

    public function topSelling()
    {
        return $this->hasOne(TopSelling::class, 'product_id')->where('is_version', true);
    }
}
