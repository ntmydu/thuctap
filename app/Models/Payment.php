<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_method',
        'status'
    ];
    public function order()
    {
        return $this->hasMany(Order::class, 'prayment_id', 'id');
    }
}