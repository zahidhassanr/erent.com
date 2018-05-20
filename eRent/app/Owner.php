<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public function user()
    {
        return $this->hasOne('App\User','owner_id','id');
    }

    Public function property()
    {
        return $this->hasMany('App\Properties','id','properties_id');
    }
}
