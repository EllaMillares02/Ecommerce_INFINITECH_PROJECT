<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'first_name', 
        'last_name', 
        'street', 
        'barangay', 
        'city_municipality', 
        'province', 
        'postal_code',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getFullAddressAttribute()
{
    return "{$this->street}, {$this->barangay}, {$this->city_municipality}, {$this->province}, {$this->postal_code}";
}

}

