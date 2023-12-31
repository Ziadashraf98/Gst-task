<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'description' , 'price' , 'old_price' , 'image' , 'category_id'];

    public function getImageAttribute($value)
    {
        return asset('images/products/'.$value);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class , 'product_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }
}
