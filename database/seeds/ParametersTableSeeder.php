<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('parameters')->delete();
        
        \DB::table('parameters')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'email:notice',
                'value' => 'corzo.pabloariel@gmail.com',
                'created_at' => '2020-08-27 13:19:04',
                'updated_at' => '2020-08-27 13:19:04',
            ),
            1 => 
            array (
                'id' => 3,
                'type' => 'email:reply',
                'value' => 'corzo.pabloariel@gmail.com',
                'created_at' => '2020-08-27 13:20:18',
                'updated_at' => '2020-08-27 13:20:18',
            ),
            2 => 
            array (
                'id' => 4,
                'type' => 'email:statement',
                'value' => 'corzo.pabloariel@gmail.com',
                'created_at' => '2020-08-27 13:20:33',
                'updated_at' => '2020-08-27 13:20:33',
            ),
            3 => 
            array (
                'id' => 5,
                'type' => 'paginate',
                'value' => '15',
                'created_at' => '2020-08-27 13:20:41',
                'updated_at' => '2020-08-27 13:25:31',
            ),
        ));
        
        
    }
}