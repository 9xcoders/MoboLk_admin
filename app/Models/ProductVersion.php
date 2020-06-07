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

    public function versionFeatures()
    {
        return $this->hasMany(ProductFeature::class)->where('is_version', true);
    }
}
