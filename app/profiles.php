<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    //
    protected $fillable = [
        'users_id', 'bday', 'contact', 'address', 'transactions'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

}
