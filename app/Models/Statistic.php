<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_orders',
        'total_revenue',
        'total_customers',
        'total_products',
        'date',
    ];
}
