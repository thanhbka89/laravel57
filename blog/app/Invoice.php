<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'order_id', 'paid_amount',
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
