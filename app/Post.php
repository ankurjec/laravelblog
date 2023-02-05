<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];  


    public function category()
    {
        return $this->hasOne('App\Category','id');
        }

}
