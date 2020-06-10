<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    protected $table = 'banner_images';
    protected $primaryKey = 'id';
    protected $fillable = ['image_url'];
}
