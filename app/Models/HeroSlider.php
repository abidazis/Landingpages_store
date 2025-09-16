<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    protected $fillable = ['image_url', 'title', 'subtitle', 'is_active', 'order'];
}
