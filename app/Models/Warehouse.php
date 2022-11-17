<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'quantity',
    ];

    protected $table = 'Warehouse';

    public $timestamps = false;

}