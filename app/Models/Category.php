<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    use SoftDeletes;

    public function categoryBrands()
    {
        return $this->hasMany(BrandCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
