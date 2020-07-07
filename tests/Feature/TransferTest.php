<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Wallet;
use App\Transfer;

//OJO este test sera para enviar datos de un transfer al API x eso el Post en el nombre abajo en el metodo.
class TransferTest extends TestCase
{
    // OJO con esta linea limpio la base despues de ejecutar las pruebas.
    //. use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void 
     */
    public function testPostTransfer()
    {
        // obteniendo los datos aleatorios con factory para enviarlos al API.
        // creamos directamente un wallet en la base y sig linea enviamos un transfer al API 
        $wallet = factory(Wallet::class)->create();
        // creando obj en memoria para actualizar abajo la propiedad wallet_id de este obj transfer q
        // existe en memoria para mas abajo enviar este obj transfer al API q se encargara de salvarlo a la base.
        $transfer = factory(Transfer::class)->make();

        // enviamos una peticion al API usando path /transfer
        // para almacenar datos de un transfer y le pasamos en un arreglo la info
        // y en response almacenamos la respuesta del API.
        $response = $this->json('POST','/api/transfer',[
            'description'  =>  $transfer->description,
            'amount'        =>  $transfer->amount,
            'wallet_id'     =>  $wallet->id
        ]);

        //validando la info q recibimos del API junto con el status de la respuesta 201
        // el cual indicaria que la info del transfer se almaceno en la base exitosamente.
        $response->assertJsonStructure([
            'id','description','amount','wallet_id'
        ])->assertStatus(201);

        // accedemos a la base para validar q la informacion transfer se almaceno entrando a la tabla 
        // transfers y ver si existe algo con las propiedades...
        $this->assertDatabaseHas('transfers',[
            'description'   =>  $transfer->description,
            'amount'        =>  $transfer->amount,
            'wallet_id'     =>  $wallet->id
        ]);

        // nuevamente accedemos a la base para validar q la informacion wallet se almaceno entrando a la tabla
        // wallet y ver si existe algo con las propiedades ...
        // ????? es validacion o es una operacion. 
        $this->assertDatabaseHas('wallets',[
            'id'        =>  $wallet->id,
            'money'     =>  $wallet->money + $transfer->amount
        ]);
        
    }
}

