<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopSettings extends Model
{
    protected $table = 'shop_settings';
    protected $primaryKey = 'id';

    protected $fillable = ['shop_name', 'shop_logo', 'address_line_1',
        'address_line_2', 'address_line_3', 'latitude', 'longitude', 'hotline'
        , 'mobile', 'tel', 'email', 'facebook_link', 'instagram_link', 'twitter_link', 'youtube_link'
    ];

}
