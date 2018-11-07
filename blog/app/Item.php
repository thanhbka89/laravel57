<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    #One To Many Relationships
    public function orders(){
        return $this->hasMany(Order::class);
    }

    /**
    * The users that belong to the item.
    */
    public function users()
    {

        return $this->belongsToMany(User::class, 'user_item');
    }
}
