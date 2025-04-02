<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Payment;

class Order extends Model
{
    use HasFactory;
    protected $keyType = 'string'; // Thay đổi kiểu khóa chính thành string
    public $incrementing = false; // Tắt tính năng auto-increment
    protected $fillable = [
        'id',
        'customer_id',
        'product_id',
        'payment_id',
        'quantity',
        'price',
        'note'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id'); // Sử dụng belongsTo cho quan hệ một-nhiều
    }

    // Định nghĩa mối quan hệ với Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id'); // Sử dụng belongsTo
    }

    // Định nghĩa mối quan hệ với Payment
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id'); // Sử dụng belongsTo
    }
    public function productord()
    {
        return $this->hasMany(ProductsOrder::class, 'order_id', 'id');
    }
}