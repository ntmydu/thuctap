<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image',
        'blog_id'
    ];
    public function imagebl()
    {
        return $this->hasOne(Blog::class, 'id', 'blog_id');
    }
}
