<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandCategory extends Model
{
    protected $table = 'brand_categories';
    protected $primaryKey = 'id';

    protected $fillable = ['brand_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
