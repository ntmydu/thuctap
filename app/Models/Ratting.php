<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratting extends Model
{
    use HasFactory;
    protected $keyType = 'string'; // Thay đổi kiểu khóa chính thành string
    public $incrementing = false; // Tắt tính năng auto-increment
    protected $table = 'rattings';
    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'rating',
        'comment'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}