<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotDeal extends Model
{
    protected $table = 'hot_deals';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'button_text', 'image_url', 'category_id'];
}
