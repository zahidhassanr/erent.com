<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function customer()
    {
        return $this->hasMany('App\Customer','customer_id','id');
    }

    public function owner()
    {
        return $this->hasMany('App\Owner','owner_id','id');
    }
}
