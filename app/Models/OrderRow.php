<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRow extends Model
{
    use HasFactory;

    //relation to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //relation to Game
    public function game()
    {
        return $this->hasOne(Game::class);
    }
}
