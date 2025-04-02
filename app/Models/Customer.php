<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;


class Customer extends Model
{
    use HasFactory;
    protected $keyType = 'string'; // Thay đổi kiểu khóa chính thành string
    public $incrementing = false; // Tắt tính năng auto-increment
    protected $fillable = [
        'id',
        'name',
        'phone',
        'address',
        'email',
        'content'
    ];

    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
}