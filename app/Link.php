<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function user_info(){

        return $this->hasOne('App\User', 'id', 'user_id');
        
    }
}
