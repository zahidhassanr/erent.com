<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','customer_id','id');
    }

    Public function property()
    {
        return $this->hasMany('App\Properties','id','properties_id');
    }

}
