<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopSelling extends Model
{
    protected $table = 'top_sellings';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'category_id', 'is_version'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function version()
    {
        return $this->belongsTo(ProductVersion::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
