<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    public $timestamps = false;
    
    protected $fillable = [
        'name', 'brand', 'code', 'status', 'quantity', 'price', 'imageurl', 'description'
    ];

    //
}
