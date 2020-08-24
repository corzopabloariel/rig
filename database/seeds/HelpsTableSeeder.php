<?php

use Illuminate\Database\Seeder;

class HelpsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('helps')->delete();
        
        \DB::table('helps')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'INP.EMAIL.LOGIN',
                'data' => 'Email registrado en el sistema',
                'created_at' => '2020-08-23 21:40:02',
                'updated_at' => '2020-08-23 21:40:02',
            ),
        ));
        
        
    }
}