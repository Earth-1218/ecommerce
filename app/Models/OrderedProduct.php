<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'quantity',
        'product_id'
    ];
    public function product(){
        return $this->belongsTo(Product::class, 'product_id'); // Corrected the foreign key here
    }
}
