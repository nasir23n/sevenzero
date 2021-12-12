<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'paid',
        'combo_disc',
        'referrer',
        'done',
        'varifide_by'
    ];

    public function sell() {
        return $this->hasMany(Sell::class);
    }
}
