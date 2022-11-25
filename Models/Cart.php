<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user()
    {
        //Un carrello è di un solo utente
        return $this->belongsTo('App\Models\User');
    }

    public function orders()
    {
        //Un carrello può contenere tanti ordini
        return $this->hasMany('App\Models\Order');
    }
}
