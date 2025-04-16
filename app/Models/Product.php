<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Notifications\Notifiable;
use App\Models\Upload;
use App\Models\Order;
use App\Models\Menu;

class Product extends Model
{
    use HasFactory;
    protected $keyType = 'string'; // Thay đổi kiểu khóa chính thành string
    public $incrementing = false; // Tắt tính năng auto-increment
    protected $table = 'products';
    protected $fillable = [
        'id',
        'name',
        'description',
        'menu_id',
        'content',
        'instructions',
        'stock',
        'price',
        'price_sale',
        'status'
    ];

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')->withDefault(['name' => '']);
    }
    public function image()
    {
        return $this->hasMany(Upload::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'product_id', 'id');
    }
}
