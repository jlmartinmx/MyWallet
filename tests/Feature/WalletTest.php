<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Wallet;
use App\Transfer;
//use DatabaseMigrations;

class WalletTest extends TestCase
{
    // OJO con esta linea limpio la base despues de ejecutar las pruebas.
    //. use RefreshDatabase;

    
    /**
     * A basic feature test example.
     *
     * @return void 
     */
    public function testGetWallet()
    {   // OJO estas 2 lineas crean datos en la base con factory, cuando le pasamos el nombre 
        // de modelo nos mapea a su factory asociado.        
        // se crea un registro.
        $wallet = factory(Wallet::class)->create();
        // en la definicion de TransferFactory seteamos wallet_id con un numero aleatorio pero como aqui ya
        //  tenemos el obj $wallet podemos tomar el valor de wallet->id q sustituya al valor aleatorio.
        // se crean 3 registros, 
        $transfers = factory(Transfer::class,3)->create([ 'wallet_id' => $wallet->id ]);


        // haciendo una peticion al API usando verbo get y path /api/wallet donde la ruta /wallet 
        // se da de alta en  ../route/api.php y para probar este path se hace desde ../vendor/bin/phpunit o
        // $ php artisan test
        $response = $this->json('GET','/api/wallet');
        // preguntamos si la peticion al API es exitosa y con assertJsonStructure(...)
        // valido q los datos q me envia el API estan en el formato correcto.
        $response->assertStatus(200)->assertJsonStructure([
            'id','money','transfers' => [ 
                            '*' => ['id','amount','description','wallet_id'] 
                           ]                            
        ]);                 

        // verificando q nos llego del API 3 objs transfers en la llave 'transfers' del obj principal JSON.        
        $this->assertCount(3,$response->json()['transfers']);

    }
}
