<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
    ];

    public function servicing() {
        return $this->hasMany(Servicing::class);
    }
    public function order() {
        return $this->hasMany(Order::class);
    }
}
