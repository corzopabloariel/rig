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
        ));
        
        
    }
}