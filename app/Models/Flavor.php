<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'name'];

    /**
     * Get the product that owns the flavor.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function sizes()
{
    return $this->hasMany(Size::class);
}
}
