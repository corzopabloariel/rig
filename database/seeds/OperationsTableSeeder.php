<?php

use Illuminate\Database\Seeder;

class OperationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('operations')->delete();
        
        \DB::table('operations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'uNqKjVmx4k',
                'name' => 'Instrucción de Venta con liquidación en moneda extrajera',
                'description' => '',
                'deleted_at' => NULL,
                'created_at' => '2020-08-24 00:25:40',
                'updated_at' => '2020-08-24 00:25:40',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'GCGjflopA5',
                'name' => 'Opción Instrucción de Compra con liquidación en pesos para su posterior venta en moneda extrajera',
                'description' => '',
                'deleted_at' => NULL,
                'created_at' => '2020-08-24 00:25:54',
                'updated_at' => '2020-08-24 00:25:54',
            ),
        ));
        
        
    }
}