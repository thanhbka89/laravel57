<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
    * Get the user that owns an order.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Get the item that owns an order.
    */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    #One To One Relationships
    public function invoice()
    {
       return $this->hasOne('App\Invoice');
    }

}
