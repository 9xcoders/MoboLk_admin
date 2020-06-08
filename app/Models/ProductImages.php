<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'id';

    protected $fillable = ['product_id', 'image_url', 'is_version'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVersion()
    {
        return $this->belongsTo(ProductVersion::class, 'product_id');
    }

}
