<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'rent_start_date', 'rent_end_date'];
}
