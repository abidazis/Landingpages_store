<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    protected $fillable = ['customer_name', 'customer_contact', 'order_date', 'status', 'notes', 'total_amount'];
}
