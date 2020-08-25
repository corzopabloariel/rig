<?php

use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('emails')->delete();
        
        \DB::table('emails')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'email' => 'corzo.pabloariel@gmail.com',
                'created_at' => '2020-08-24 03:22:12',
                'updated_at' => '2020-08-24 03:22:12',
            ),
            1 => 
            array (
                'id' => 4,
                'user_id' => 2,
                'email' => 'juantopo@gmail.com',
                'created_at' => '2020-08-24 14:34:21',
                'updated_at' => '2020-08-24 14:34:21',
            ),
            2 => 
            array (
                'id' => 5,
                'user_id' => 2,
                'email' => 'jtopo@gmail.com',
                'created_at' => '2020-08-24 14:34:21',
                'updated_at' => '2020-08-24 14:34:21',
            ),
            3 => 
            array (
                'id' => 6,
                'user_id' => 3,
                'email' => 'pepe@gmail.com',
                'created_at' => '2020-08-24 15:17:02',
                'updated_at' => '2020-08-24 15:17:02',
            ),
        ));
        
        
    }
}