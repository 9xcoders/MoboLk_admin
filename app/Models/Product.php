<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey = 'id';
    use SoftDeletes;

    protected $fillable = ['unique_id', 'name', 'slug', 'short_desc',
        'long_desc', 'price', 'off_price', 'in_stock', 'brand_id', 'category_id', 'keywords'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productVersions()
    {
        return $this->hasMany(ProductVersion::class);
    }

    public function productFeatures()
    {
        return $this->hasMany(ProductFeature::class)->where('is_version', false);;
    }
}
