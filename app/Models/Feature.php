<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    protected $table = 'features';
    protected $primaryKey = 'id';
    use SoftDeletes;
    
    protected $fillable = ['name', 'slug', 'feature_category_id'];

    public function featureCategory()
    {
        return $this->belongsTo(FeatureCategory::class);
    }
}
