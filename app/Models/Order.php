<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //relation to OrderRow
    public function orderrows()
    {
        return $this->hasMany(OrderRow::class);
    }

    //relation to User
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
