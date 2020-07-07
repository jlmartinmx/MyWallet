<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transfer;
use App\Wallet;

class TransferController extends Controller
{
    // este metodo funciona como la parte del API q almacena los datos.
    public function store(Request $request){
        // recuperar el wallet q se almaceno  en TransferTest antes de llamar a este API.
        $wallet = Wallet::find($request->wallet_id);
        //dd($wallet);
        // actualizar el atributo money q se encuentra dentro de ese wallet
        $wallet->money = $wallet->money + $request->amount;
        $wallet->update();

        // ya actualizado el wallet con su ingreso/gasto se procede a insertar
        // su transfer asociado en la base.
        $transfer = new Transfer();
        $transfer->description = $request->description;
        $transfer->amount = $request->amount;
        $transfer->wallet_id = $request->wallet_id;
        $transfer->save();

        // en nuestra prueba TransferTest se pide q la respuesta del API debe ser 
        // en formato JSON x lo tanto al obj response() aplicamos funcione json()
        // y retornamos obj response junto con status 201 de peticion exitosa.
        return response()->json($transfer,201);
    }
}
