<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function user_info(){

        return $this->hasOne('App\User', 'id', 'user_id');
        
    }
}
