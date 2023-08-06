<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'stocks',
        'sales',
        'category_id',
        'seller_id',
        'is_deleted',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
}

    public function scopeActive($query)
    {
        return $query->where('is_deleted', false);
    }
}
