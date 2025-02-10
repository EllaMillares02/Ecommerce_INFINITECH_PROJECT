<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'brand', 'description', 'information', 'price', 'discount',
        'category', 'image', 'grouping','status',
    ];
    public function sale()
    {
        return $this->hasOne(sales::class); 
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function flavors()
        {
            return $this->hasMany(Flavor::class);
        }

    /**
     * Get the sizes associated with the product.
     */
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    /**
     * Get the images associated with the product.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
