<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    //
    public $timestamps = false;
    
    protected $fillable = [
        'transaction_no', 'profile_id', 'total', 'creator_id', 'created_at',
    ];
}
