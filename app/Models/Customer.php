<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'province', 'city_municipality', 'barangay', 
        'street', 'postal_code', 'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
