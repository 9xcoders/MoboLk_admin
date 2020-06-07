<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureCategory extends Model
{
    protected $table = 'feature_categories';
    protected $primaryKey = 'id';
    use SoftDeletes;

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
