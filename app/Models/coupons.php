<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupons extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'is_active', 'valid_from', 'valid_until', 'discount_amount'];
}
