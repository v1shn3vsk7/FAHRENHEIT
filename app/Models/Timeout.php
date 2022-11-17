<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeout extends Model
{
    use HasFactory;

    protected $primaryKey = 'client';
    protected $keyType = 'string';

    protected $fillable = [
        'attempt_number',
        'client',
    ];
}
