<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\Transfer;

class WalletController extends Controller
{
    // este metodo se usa como API mediante el path /wallet para recuperar datos de la base y organizarlos en
    // formato JSON, este metodo se llama en forma indirecta desde Wallettest mediate comando 
    // $ php artisan test
    public function index(){
        // obtenemos el primer wallet
        $wallet = Wallet::firstOrFail();
        // obtenemos todas las transfers del primer wallet y junto con esta info retornamos el codigo ok de http. 
        return response()->json($wallet->load('transfers'), 200);
    }


    // este metodo lo cree para ver como se retorna los datos arriba en el metodo index().
    public function pruebawallet(){
        $wallet = Wallet::firstOrFail();
        // dd($wallet);
        
        // Salidas en formatos JSON de las sigs 2 lineas.
        
        // dd(response()->json($wallet->transfers, 200));
        // data: [{transfer1},{transfer2},{transfer3}] #statusCode:200

        dd(response()->json($wallet->load('transfers'), 200));
        // data: {wallet1  transfers:[{transfer1},{transfer2},{transfer3}] } #statusCode:200 
        // OJO este formato de linea anterior es como se espera recibir los datos desde el API ver WalletTest.php
        

    }




}// end class 
