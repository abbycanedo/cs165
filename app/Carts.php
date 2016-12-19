<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    //
    public $timestamps = false;
    
    protected $fillable = [
        'profile_id', 'transaction_no', 'product_id', 'submitted', 'active',
    ];

    //
}
