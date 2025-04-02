<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsOrder extends Model
{
    protected $keyType = 'string'; // Thay đổi kiểu khóa chính thành string
    public $incrementing = false; // Tắt tính năng auto-increment
    protected $table = 'products_orders';
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'name',
        'quantity',
        'price',
    ];

    public function Order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function Product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->withDefault(['name' => '']);
    }
}