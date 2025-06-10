<?php

namespace App\Models\URLShortner;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    //

    protected $fillable = [
        'original_url',
        'short_code',
    ];
}
