<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function cart()
    {
        //Un ordine può appartenere solo ad un carrello
        return $this->BelongsTo('App\Models\Cart');
    }

}