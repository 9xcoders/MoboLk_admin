<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureCategory extends Model
{
    protected $table = 'feature_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'slug', 'is_filter'];

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
