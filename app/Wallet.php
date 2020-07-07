<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Transfer;

class Wallet extends Model
{
    // se usa en caso de q queramos manejar un nombre de tabla diferente al default q
    // seria en este caso el nombre del modelo pero en minusculas y en plural. 
    protected $table = 'wallets';

    // creando relacion entre tablas wallets y transfers.
    // un wallet tiene muchas transferencias.
    public function transfers(){
        return $this->hasMany('App\Transfer');
    }

}
