<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function carts()
    {
        //Un utente può creare tanti carrelli
        return $this->hasMany('App\Models\Cart');
    }

}
