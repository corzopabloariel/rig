<?php

use Illuminate\Database\Seeder;

class LabelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('labels')->delete();
        
        \DB::table('labels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'LBL.EMAIL.LOGIN',
                'data' => 'E-mail',
                'created_at' => '2020-08-23 22:26:56',
                'updated_at' => '2020-08-23 22:26:56',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'LBL.EMAIL.ACCESS',
                'data' => 'E-mail',
                'created_at' => '2020-08-23 22:30:55',
                'updated_at' => '2020-08-23 22:30:55',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'LBL.PASS.ACCESS',
                'data' => 'Contraseña',
                'created_at' => '2020-08-23 22:32:53',
                'updated_at' => '2020-08-23 22:32:53',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'LBL.PASS.LOGIN',
                'data' => 'Contraseña',
                'created_at' => '2020-09-06 05:05:12',
                'updated_at' => '2020-09-06 05:05:12',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'LBL.ACCEPT',
                'data' => 'Acepto la declaración jurada',
                'created_at' => '2020-09-06 05:05:32',
                'updated_at' => '2020-09-06 05:05:32',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'MSSG.SUCCESS',
                'data' => 'Declaración activa',
                'created_at' => '2020-09-06 05:06:16',
                'updated_at' => '2020-09-06 05:06:16',
            ),
        ));
        
        
    }
}