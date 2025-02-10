<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'size', 'price', 'stock_quantity','flavor_id'];

    /**
     * Get the product that owns the size.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // In Size.php model
    public function flavor()
    {
        return $this->belongsTo(Flavor::class);
    }

}
