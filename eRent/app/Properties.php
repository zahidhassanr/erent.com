<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer','id','properties_id');
    }

    public function owner()
    {
        return $this->belongsTo('App\Owner','id','properties_id');
    }
}
