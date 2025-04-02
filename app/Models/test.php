<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    protected $keyType = 'string'; // Thay đổi kiểu khóa chính thành string
    public $incrementing = false; // Tắt tính năng auto-increment

    protected $fillable = ['id', 'name']; // Thêm trường id vào fillable
}