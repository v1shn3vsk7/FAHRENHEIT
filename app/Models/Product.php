<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manufacturer_id',
        'desc',
        'short_desc',
        'alias',
        'price',
        'catalog',
        'image',
    ];
    //public $timestamps = false;

    public function properties() {
        return $this->hasMany(Property::class, 'product', 'id');
    }
}
