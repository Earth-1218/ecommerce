<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'order_id',
        'shipping_id',
        'total',
        'details',
        'status',
        'payment_mode',
        'payment_status'
    ];

    public function orderedProducts(){
        return $this->hasMany(OrderedProduct::class);
    }
}
