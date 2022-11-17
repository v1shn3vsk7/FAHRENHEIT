<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'quantity',
        'user',
    ];

    public $timestamps = false;

    public function productt() {
        return $this->belongsTo(Product::class, 'product');
    }
}
