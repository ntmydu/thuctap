<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $keyType = 'string'; // Thay đổi kiểu khóa chính thành string
    public $incrementing = false; // Tắt tính năng auto-increment

    protected $fillable = [
        'id',
        'name',
        'parent_id',
        'description',
        'status'
    ];
}