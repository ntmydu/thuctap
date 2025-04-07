<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReturnOrd extends Model
{
    use HasFactory;
    protected $keyType = 'string'; // Thay đổi kiểu khóa chính thành string
    public $incrementing = false; // Tắt tính năng auto-increment
    protected $table = 'return_ords';
    protected $fillable = [
        'id',
        'order_id',
        'user_id',
        'reason',
        'method',
        'status'

    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}