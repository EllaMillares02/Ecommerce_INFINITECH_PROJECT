<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    protected $table = 'wishlist'; 
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
