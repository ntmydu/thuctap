<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Upload extends Model
{
    use HasFactory;

    protected $table = 'upload';
    protected $fillable = [
        'product_id',
        'image_name'
    ];
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->withDefault(['name' => '']);
    }
}
